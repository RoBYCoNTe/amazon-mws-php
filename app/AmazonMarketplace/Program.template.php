<?php 

require_once ("Mwse/Config.php");
require_once ("Mwse/Client.php");
require_once ("Mwse/Exception.php");
require_once ("Mwse/Xml/AmazonEnvelope.php");
require_once ("Mwse/Xml/Product.php");
require_once ("Mwse/Xml/Price.php");
require_once ("Mwse/Xml/Inventory.php");
require_once ("Mwse/Xml/Deserializer.php");
require_once ("Mwse/Xml/ProductImage.php");
require_once ("Mwse/Xml/LengthDimension.php");
require_once ("Mwse/Xml/PositiveNonZeroWeightDimension.php");
require_once ("Mwse/Xml/Relationship.php");
require_once ("Mwse/Xml/ProductData/Clothing.php");
require_once ("Mwse/Xml/ProductData/ClothingVariationData.php");
require_once ("Mwse/Xml/ProductData/ClothingClassificationData.php");

// Product Feeds Handler.
require_once ("FeedSubmissionData.php");
require_once ("FeedSubmissionJsonDataManager.php");

try {
  // Set mws required configuration params.
  $config = new MwseConfig([
    'serviceUrl' => 'https://mws.amazonservices.it',
    'accessKeyId' => '',
    'secretAccessKey' => '',
    'accessToken' => '',
    'merchantId' => '',
    'applicationName' => 'TEST APP',
    'applicationVersion' => '1.0'
  ]);  
  
  $action = isset($_GET['Action']) ? $_GET['Action'] : 'None';
  $subAction = isset($_GET['SubAction']) ? $_GET['SubAction'] : 'Default';
  $productSKU = isset($_GET['SKU']) ? $_GET['SKU'] : '10-MYDP-001S';
  $marketplaceId = isset($_GET['MarketplaceId']) ? $_GET['MarketplaceId'] : "APJ6JRA9NG5V4";

  $client = new MwseClient($config);
  $productSKU = "10-MYDP-002S";
  $marketplaceId = "APJ6JRA9NG5V4";

  $productFeedDataManager = new FeedSubmissionJsonDataManager();
  
  function enqueue_feed_request($feedRequest, $feedResponse) {
    $productFeedDataManager = new FeedSubmissionJsonDataManager();
    $productFeed = new FeedSubmissionData();
    $productFeed->setSubmissionId($feedResponse->getSubmitFeedResult()->getFeedSubmissionInfo()->getFeedSubmissionId());
    $productFeed->setStatus(FeedSubmissionData::PENDING);
    $productFeed->setRequest($feedRequest);
    $productFeed->setResponse($feedResponse);
    $productFeed->setField("crc32", crc32($feedRequest['feed']));
    $productFeedDataManager->create($productFeed);
  };

  if (file_exists("Tests" . DIRECTORY_SEPARATOR . "$action.php")) {
    require_once ("Tests" . DIRECTORY_SEPARATOR . "$action.php");
    
  }
  else {
    header ("Content-Type: text/plain");
    print "Bro you write an invalid action, what you wanna do?";
  }
}
catch(MwseException $e) {
  if (!headers_sent()) header("Content-Type: text/plain");
  echo("Oops!" . PHP_EOL);
  echo("Error: " . $e->getMessage() . PHP_EOL);
}
catch(MarketplaceWebServiceOrders_Exception $ex) {
  if (!headers_sent()) header("Content-Type: text/plain");
  echo("Caught Exception: " . $ex->getMessage() . "\n");
  echo("Response Status Code: " . $ex->getStatusCode() . "\n");
  echo("Error Code: " . $ex->getErrorCode() . "\n");
  echo("Error Type: " . $ex->getErrorType() . "\n");
  echo("Request ID: " . $ex->getRequestId() . "\n");
  echo("Error message: " . $ex->getErrorMessage() . "\n");
  echo("XML: " . $ex->getXML() . "\n");
  echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");  
}
catch(MarketplaceWebService_Exception $ex) {
  if (!headers_sent()) header("Content-Type: text/plain");
  echo("Caught Exception: " . $ex->getMessage() . "\n");
  echo("Response Status Code: " . $ex->getStatusCode() . "\n");
  echo("Error Code: " . $ex->getErrorCode() . "\n");
  echo("Error Type: " . $ex->getErrorType() . "\n");
  echo("Request ID: " . $ex->getRequestId() . "\n");
  echo("Error message: " . $ex->getErrorMessage() . "\n");
  echo("XML: " . $ex->getXML() . "\n");
  echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");  
}
catch(Error $e) {
  header("Content-Type: text/plain");
  echo("Oops!" . PHP_EOL);
  echo("Error: " . $e->getMessage() . PHP_EOL);
  echo("Stack Trace: " . $e->getTraceAsString() . PHP_EOL);
}