<?php

require_once ("ProductDescriptionData.php");

class MwseXmlProduct {
  const GTIN_EXEMPTION_REASON_BUNDLE = "bundle";
  const GTIN_EXEMPTION_REASON_PART = "part";

  const OFF_AMAZON_CHANNEL_ADVERTISE = "advertise";
  const OFF_AMAZON_CHANNEL_EXCLUDE = "exclude";

  const ON_AMAZON_CHANNEL_SELL = "sell";
  const ON_AMAZON_CHANNEL_ADVERISE = "advertise";
  const ON_AMAZON_CHANNEL_EXCLUDE = "exclude";

  const REGISTERED_PARAMETER_PRIVATE_LABEL = "PrivateLabel";
  const REGISTERED_PARAMETER_SPECIALIZED = "Specialized";
  const REGISTERED_PARAMETER_NON_CONSUMER = "NonConsumer";
  const REGISTERED_PARAMETER_PRE_CONFIGURED = "PreConfigured";

  private $_operationType = "Update";
  private $_descriptionData;

  private $_data = [
    'SKU' => null,
    'StandardProductID' => [],
    'GtinExemptionReason' => null,
    'RelatedProductID' => null,
    'ProductTaxCode' => null,
    'LaunchDate' => null,
    'DiscontinueDate' => null,
    'ReleaseDate' => null,
    'ExternalProductUrl' => null,
    'OffAmazonChannel' => null,
    'OnAmazonChannel' => null,
    'Condition' => null,
    'Rebate' => null,
    'ItemPackageQuantity' => 0,
    'NumberOfItems' => null,
    'LiquidVolume' => null,
    'DescriptionData' => [],
    'PromoTag' => [],
    'DiscoveryData' => [],
    'ProductData' => [],
    'ShippedByFreight' => "false",
    'EnhanchedImageURL' => null,
    'Amazon-Vendor-Only' => null,
    'Amazon-Only' => null,
    'RegisteredParameter' => null
  ];


  function __construct() {
    $this->_descriptionData = new MwseXmlProductDescriptionData($this);
  }

  /**
   * Used to identify an individual product. Each product must have a SKU, and each SKU must be unique.
   *
   * @param String $sku
   * @return MwseXmlProduct
   */
  public function setSKU($sku) {
    $this->_data['SKU'] = $sku;
    return $this;
  }

  /**
   * A standard, unique identifier for a product, consisting of a type (ISBN, UPC, or EAN) and a value that 
   * conforms to the appropriate format for the type specified. 
   * This is a required field if Type is provided for StandardProductID in the base XSD.
   *
   * @param Array $standardProductID Array of Value/Type element tuples.
   * @return MwseXmlProduct
   */
  public function setStandardProductID($standardProductID) {
    $this->_data['StandardProductID'] = $standardProductID;
    return $this;
  }

  /**
   * @see setStandardProductID
   *
   * @param String $type Can be: ISBN, UPC, EAN, ASIN, GTIN
   * @param String $value Min length: 8, Max length: 14
   * @return MwseXmlProduct
   */
  public function setStandardProductIDItem($type, $value) {
    $types = array_column($this->_data['StandardProductID'], 'Type');
    if (in_array($type, $types)) {
      throw new MwseException("Specified standard product id type already specified: $type.");
    }
    
    $this->_data['StandardProductID'][] = ['Type' => $type, 'Value' => $value];
    return $this;
  }

  public function setShippedByFreight($value) {
    $this->_data['ShippedByFreight'] = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? "True" : "False";
    return $this;
  }

  public function setEnhachedImageURL($value) {
    $this->_data["EnhachedImageURL"] = $value;
    return $this;
  }

  /**
   * Controls when the product appears in search and browse on the Amazon website
   *
   * @param DateTime $launchDate UTC format.
   * @return MwseXmlProduct
   */
  public function setLaunchDate($launchDate) {
    $this->_data['LaunchDate'] = $launchDate;
    return $this;
  }

  /**
   * The date a product is released for sale.
   *
   * @param DateTime $releaseDate UTC format.
   * @return MwseXmlProduct
   */
  public function setReleaseDate($releaseDate) {
    $this->_data['ReleaseDate'] = $releaseDate;
    return $this;
  }

  /**
   * The condition of the item.
   *
   * @param String $condition One of: New, UsedLikeNew, UsedVeryGood, UsedAcceptable, CollectibleLikeNew, CollectibleVeryGood, CollectibleGood, CollectibleAcceptable, Refurbished, Club.
   * @return MwseXmlProduct
   */
  public function setCondition($condition) {
    $this->_validateEnumValue($condition, [
      'New', 
      'UsedLikeNew', 
      'UsedVeryGood', 
      'UsedAcceptable', 
      'CollectibleLikeNew', 
      'CollectibleVeryGood', 
      'CollectibleGood', 
      'CollectibleAcceptable',
      'Refurbished',
      'Club']);
    $this->_data['Condition'] = $condition;
    return $this; 
  }

  /**
   * Number of the same product contained within one package. 
   * For example, if you are selling a case of 10 packages of socks, ItemPackageQuantity would be 10.
   *
   * @param Number $itemPackageQuantity
   * @return MwseXmlProduct
   */
  public function setItemPackageQuantity($itemPackageQuantity) {
    $this->_data['ItemPackageQuantity'] = $itemPackageQuantity;
    return $this;
  }

  /**
   * Number of discrete items included in the product you are offering for sale, such that each item is not packaged for individual sale. 
   * For example, if you are selling a case of 10 packages of socks, and each package contains 3 pairs of socks, NumberOfItems would be 30.
   *
   * @param Number $numberOfItems
   * @return MwseXmlProduct
   */
  public function setNumberOfItems($numberOfItems) {
    $this->_data['NumberOfItems'] = $numberOfItems;
    return $this;
  }

  public function setRegisteredParameter($value) {
    $this->_data['RegisteredParameter'] = $value;
    return $this;
  }

  /**
   * Section containing category-specific information such as variations. 
   * Reference one or more of the following XSDs to complete the ProductData 
   * section (only one category can be used for a given item).
   *
   * @param Object $productData
   * @return MwseXmlProduct
   */
  public function setProductData($productData) {
    $this->_data['ProductData'] = $productData->getData();
    return $this;
  }


  /**
   * The optional OperationType element can be used to specify the type of operation (Update, Delete or PartialUpdate) 
   * to be performed on the data. The OperationType is only applicable to product-related feeds (Product, Inventory, Price, etc) 
   * and will be ignored for non-applicable feeds.
   *  - If you use Update, all specified information overwrites any existing information. Any unspecified information is erased.
   *  - If you use Delete, all information is removed.
   *  - For Product feeds only: If you use PartialUpdate for a Product feed, all specified information overwrites any existing information, 
   *    but unspecified information is unaffected. Caution: This operation type is only valid for Product feeds. If this operation type 
   *    is used for any other feed type, such as Inventory and Price feeds, unpredictable data loss can occur.
   *  
   * To simply replace all existing data with new data, use PurgeAndReplace as part of the amzn-envelope.xsd instead of OperationType. 
   * If you use the PurgeAndReplace element as part of the amzn-envelope.xsd, then OperationType is ignored and the data you upload completely replaces 
   * all existing data, even for unspecified SKUs.
   *
   * @param String $operationType
   * @return FeedProduct
   */
  public function setOperationType($operationType) {
    $this->_operationType = $operationType;
    return $this;
  }

  public function getOperationType() {
    return $this->_operationType;
  }

  public function getDescriptionData() {
    return $this->_descriptionData;
  }

  public static function create() {
    return new MwseXmlProduct();
  }

  public function getData() {
    $data = $this->_data;
    $data['DescriptionData'] = $this->_descriptionData->getData();
    $data = array_filter($data);
    return ['Product' => $data];
  }

  function _validateEnumValue($value, $enum) {
    if (!in_array($value, $enum)) {
      throw new Exception("Invalid enum value '$value', accepted values are: " . implode(",", $enum));
    }
  }
}