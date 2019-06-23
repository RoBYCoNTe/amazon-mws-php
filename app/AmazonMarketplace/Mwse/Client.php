<?php 

require_once ("Exception.php");
require_once ("Config.php");
// Feeds
require_once (__DIR__ . "/../MarketplaceWebService/Client.php");
require_once (__DIR__ . "/../MarketplaceWebService/Model/IdList.php");
require_once (__DIR__ . "/../MarketplaceWebService/Model/SubmitFeedRequest.php");
require_once (__DIR__ . "/../MarketplaceWebService/Model/GetFeedSubmissionResultRequest.php");

// Orders
require_once (__DIR__ . "/../MarketplaceWebServiceOrders/Client.php");
require_once (__DIR__ . "/../MarketplaceWebServiceOrders/Model/ListOrdersRequest.php");
require_once (__DIR__ . "/../MarketplaceWebServiceOrders/Model/ListOrdersResponse.php");
require_once (__DIR__ . "/../MarketplaceWebServiceOrders/Model/ListOrderItemsRequest.php");
require_once (__DIR__ . "/../MarketplaceWebServiceOrders/Model/ListOrderItemsResponse.php");

/**
 * @author Roberto Conte Rosito <roberto.conterosito@gmail.com>
 */
class MwseClient {
  private $_config;
  private $_serviceConfig;
  private $_service;
  private $_ordersService;
  private $_ordersConfig;
  

  function __construct(MwseConfig $config) {
    $this->_config = $config->validate();
    $this->_serviceConfig = [
      'ServiceURL' => $config->getServiceUrl(),
      'ProxyHost' => null,
      'ProxyPort' => -1,
      'MaxErrorRetry' => 3
    ];
    $this->_ordersConfig = [
      'ServiceURL' => $config->getServiceUrl() . "/Orders/2013-09-01",
      'ProxyHost' => null,
      'ProxyPort' => -1,
      'MaxErrorRetry' => 3
    ];
    try {
      $this->_service = new MarketplaceWebService_Client(
        $this->_config->getAccessKeyId(),
        $this->_config->getSecretAccessKey(),
        $this->_serviceConfig,
        $this->_config->getApplicationName(),
        $this->_config->getApplicationVersion()
      );
      $this->_ordersService = new MarketplaceWebServiceOrders_Client(
        $this->_config->getAccessKeyId(),
        $this->_config->getSecretAccessKey(),
        $this->_config->getApplicationName(),
        $this->_config->getApplicationVersion(),
        $this->_ordersConfig
      );
    }
    catch(Exception $e) {
      throw new MwseException("Error configuring services: " . $e->getMessage());
    }
  }

  /**
   * Validate Array request's parameters without the requirement to use class.
   *
   * @param Array $request Array of parameters to validate.
   * @param array $params Parameters configuration (required or not).
   * @return Array Returns validated request.
   */
  function _validateRequest($request, $params = []) {
    $names = array_keys($params);
    foreach($names as $paramName) {
      $config = $params[$paramName];
      $required = isset($config['required']) && $config['required'] === true;
      if ($required && (!isset($request[$paramName]) || empty($request[$paramName]))) {
        throw new MwseException("Request validation fails: required parameter '$paramName' not specified.");
      }
    } 
    return $request;
  }

  function _generateRandomText($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ12345689';
    $myString = '';
    for ($i = 0; $i < $length; $i++) {
      $pos = mt_rand(0, strlen($chars) -1);
      $myString .= substr($chars, $pos, 1);
    }
    return $myString;
  }

  function _calculateMd5($data) {
    $md5Hash = null;
    if (is_string($data)) {
      $md5Hash = md5($data, true);
    } elseif (is_resource($data)) {
      // Assume $data is a stream.
      $streamMetadata = stream_get_meta_data($data);

      if ($streamMetadata['stream_type'] === 'MEMORY' || $streamMetadata['stream_type'] === 'TEMP') {
        $md5Hash = md5(stream_get_contents($data), true);
      } else {
        $md5Hash = md5_file($streamMetadata['uri'], true);
      }
    }
    $md5 = base64_encode($md5Hash);
    return $md5;
  }

  function _createFeedHandle($feed, $dir, $permissions = 'r') {
    $filename = $dir . date('Ymd-His-') . $this->_generateRandomText() . ".xml";
    file_put_contents($filename, $feed);
    
    $handle = fopen($filename, $permissions);
    rewind($handle);

    $md5 = $this->_calculateMd5($handle);
    
    return [
      'filepath' => $filename,
      'handle' => $handle,
      'md5' => $md5
    ];
  }

  public function submitProduct($request) {
    return $this->submitFeed($request, "_POST_PRODUCT_DATA_");
  }
  public function submitPrice($request) {
    return $this->submitFeed($request, '_POST_PRODUCT_PRICING_DATA_');
  }
  public function submitImages($request) {
    return $this->submitFeed($request, '_POST_PRODUCT_IMAGE_DATA_');
  }
  public function submitInventory($request) {
    return $this->submitFeed($request, '_POST_INVENTORY_AVAILABILITY_DATA_');
  }
  public function submitRelationship($request) {
    return $this->submitFeed($request, '_POST_PRODUCT_RELATIONSHIP_DATA_');
  }
  private function submitFeed($request = [], $feedType) {
    $request = $this->_validateRequest($request, [
      'feed' => ['required' => true],
      'marketplaceId' => ['required' => true]
    ]);
    
    $feed = $request['feed'];
    $feed = $this->_createFeedHandle($feed, __DIR__ . DIRECTORY_SEPARATOR . 'Staging/FeedSubmissions/');

    $webRequest = new MarketplaceWebService_Model_SubmitFeedRequest();
    $webRequest->setMerchant($this->_config->getMerchantId());
    $webRequest->setMarketplaceIdList(['Id' => [$request['marketplaceId']]]);
    $webRequest->setFeedType($feedType);
    $webRequest->setContentMd5($feed['md5']);
    rewind($feed['handle']);

    $webRequest->setPurgeAndReplace(false);
    $webRequest->setFeedContent($feed['handle']);
    rewind($feed['handle']);

    return $this->_service->submitFeed($webRequest);
  }

  public function getFeedSubmissionResult($request) {
    $request = $this->_validateRequest($request, [
      'feedSubmissionId' => ['required' => true]
    ]);
    $feed = $this->_createFeedHandle('', __DIR__ . DIRECTORY_SEPARATOR . 'Staging/FeedResults/', 'w+');
    
    $webRequest = new MarketplaceWebService_Model_GetFeedSubmissionResultRequest();
    $webRequest->setMerchant($this->_config->getMerchantId());
    $webRequest->setFeedSubmissionId($request['feedSubmissionId']);
    $webRequest->setFeedSubmissionResult($feed['handle']);

    $this->_service->getFeedSubmissionResult($webRequest);

    $xmlContent = file_get_contents($feed['filepath']);
    $xml = new SimpleXMLElement($xmlContent);
    
    return [
      'status' => $xml->Message->ProcessingReport->StatusCode,
      'result_code' => strval($xml->Message->ProcessingReport->Result->ResultCode),
      'result_message_code' => strval($xml->Message->ProcessingReport->Result->ResultMessageCode),
      'result_description' => strval($xml->Message->ProcessingReport->Result->ResultDescription),
      'successful' => strval($xml->Message->ProcessingReport->ProcessingSummary->MessagesSuccessful),
      
    ];
  }

  public function listOrders(DateTime $createdAfter, DateTime $createdBefore, $marketplaceId) {
    $xmlRequest = new MarketplaceWebServiceOrders_Model_ListOrdersRequest();
    $xmlRequest->setSellerId($this->_config->getMerchantId());
    
    $xmlRequest->setCreatedAfter($createdAfter->format('c'));
    $xmlRequest->setCreatedBefore($createdBefore->format('c'));

    $xmlRequest->setMarketplaceId($marketplaceId);
    
    $list = [];
    $response = $this->_ordersService->listOrders($xmlRequest);
    $list = array_merge($list, $this->_mapListOrdersResponse($response));
    
    
    return $list;
  }

  public function listOrderItems(String $amazonOrderId) {
    $xmlRequest = new MarketplaceWebServiceOrders_Model_ListOrderItemsRequest();
    $xmlRequest->setAmazonOrderId($amazonOrderId);
    $xmlRequest->setSellerId($this->_config->getMerchantId());
    
    $list = [];
    $response = $this->_ordersService->listOrderItems($xmlRequest);
    $list = array_merge($list, $this->_mapListOrderItemsResponse($response));

    return $list;
  }

  private function _mapListOrderItemsResponse(MarketplaceWebServiceOrders_Model_ListOrderItemsResponse $response) {
    $orderItems = $response->getListOrderItemsResult();
    $list = [];
    foreach($orderItems->getOrderItems() as $orderItem) {
      $list[] = $this->_convertOrderItem($orderItem);
    }
    return $list;
  }

  private function _mapListOrdersResponse(MarketplaceWebServiceOrders_Model_ListOrdersResponse $response) {
    $orders = $response->getListOrdersResult();
    $list = [];
    foreach($orders->getOrders() as $order) {
      $list[] = $this->_convertOrder($order);
    }
    return $list;
  }
  
  private function _convertOrderItem(MarketplaceWebServiceOrders_Model_OrderItem $orderItem) {
    return [
      'asin' => $orderItem->getASIN(),
      'seller_sku' => $orderItem->getSellerSKU(),
      'order_item_id' => $orderItem->getOrderItemId(),
      'title' => $orderItem->getTitle(),
      'quantity_ordered' => $orderItem->getQuantityOrdered(),
      'quantity_shipped' => $orderItem->getQuantityShipped(),
      'points_granted' => $orderItem->getPointsGranted(),
      'item_price_currency_code' => $orderItem->getItemPrice()->getCurrencyCode(),
      'item_price_amount' => $orderItem->getItemPrice()->getAmount(),
      'shipping_price_currency_code' => $orderItem->getShippingPrice()->getCurrencyCode(),
      'shipping_price_amount' => $orderItem->getShippingPrice()->getAmount(),
      'item_tax_currency_code' => $orderItem->getItemTax()->getCurrencyCode(),
      'item_tax_amount' => $orderItem->getItemTax()->getAmount()
    ];
  }
  private function _convertOrder(MarketplaceWebServiceOrders_Model_Order $order) {
    return [
      'amazon_order_id' => $order->getAmazonOrderId(),
      'buyer_county' => $order->getBuyerCounty(),
      'buyer_name' => $order->getBuyerName(),
      'buyer_email' => $order->getBuyerEmail(),
      'buyer_tax_info' => $order->getBuyerTaxInfo(),
      'cba_displayable_shipping_label' => $order->getCbaDisplayableShippingLabel(),
      'earliest_delivery_date' => $order->getEarliestDeliveryDate(),
      'earliest_ship_date' => $order->getEarliestShipDate(),
      'is_business_order' => $order->getIsBusinessOrder(),
      'is_premium_order' => $order->getIsPremiumOrder(),
      'is_prime' => $order->getIsPrime(),
      'last_update' => $order->getLastUpdateDate(),
      'latest_delivery_date' => $order->getLatestDeliveryDate(),
      'latest_ship_date' => $order->getLatestShipDate(),
      'marketplace_id' => $order->getMarketplaceId(),
      'number_of_items_shipped' => $order->getNumberOfItemsShipped(),
      'number_of_items_unshipped' => $order->getNumberOfItemsUnshipped(),
      'order_channel' => $order->getOrderChannel(),
      'order_status' => $order->getOrderStatus(),
      'order_total_currency_code' => $order->getOrderTotal()->getCurrencyCode(),
      'order_total_amount' => $order->getOrderTotal()->getAmount(),
      'order_type' => $order->getOrderType(),
      'payment_method' => $order->getPaymentMethod(),
      'purchase_date' => $order->getPurchaseDate(),
      'sales_channel' => $order->getSalesChannel(),
      'seller_order_id' => $order->getSellerOrderId(),
      'shipment_service_level_category' => $order->getShipmentServiceLevelCategory(),
      'shipped_by_amazon_tfm' => $order->getShippedByAmazonTFM(),
      'shipping_address_name' => $order->getShippingAddress()->getName(),
      'shipping_address_line1' => $order->getShippingAddress()->getAddressLine1(),
      'shipping_address_line2' => $order->getShippingAddress()->getAddressLine2(),
      'shipping_address_line3' => $order->getShippingAddress()->getAddressLine3(),
      'shipping_address_city' => $order->getShippingAddress()->getCity(),
      'shipping_address_county' => $order->getShippingAddress()->getCounty(),
      'shipping_address_district' => $order->getShippingAddress()->getDistrict(),
      'shipping_address_state_or_region' => $order->getShippingAddress()->getStateOrRegion(),
      'shipping_address_postal_code' => $order->getShippingAddress()->getPostalCode(),
      'shipping_address_country_code' => $order->getShippingAddress()->getCountryCode(),
      'shipping_address_phone' => $order->getShippingAddress()->getPhone(),
      'ship_service_level' => $order->getShipServiceLevel(),
      'tfm_shipment_status' => $order->getTFMShipmentStatus(),
      'items' => $this->listOrderItems($order->getAmazonOrderId())
    ];
  }

}