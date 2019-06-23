<?php

require_once ("AmazonMarketplace/Autoload.php");
require_once ("createProduct.php");
require_once ("createProductImages.php");

header ("Content-Type: text/plain");

$config = [
  'service_url' => '',
  'access_key_id' => '',
  'secret_access_key' => '',
  'access_token' => '',
  'merchant_id' => ''
]; 

$marketplaceId = "APJ6JRA9NG5V4";
$sampleQueue = new AMJsonQueueManager();

$product = AMQueueItem::submitProduct($marketplaceId, createProduct(['sku' => "SZ-MYDP-002S"])->getXML(), $config);
$productImages = AMQueueItem::submitImages($marketplaceId, createProductImages(['sku' => "SZ-MYDP-002S"])->getXML(), $config);

$sampleQueue->enqueue($productImages);
$sampleQueue->submit(10);
$sampleQueue->sync(10);

