<?php 
$productSKU = $_GET['SKU'];
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("ProductImage");
$productImage = new MwseXmlProductImage();
$productImage->setImageLocation("https://www.tramabianca.it/wp-content/uploads/2019/04/popl200_rb_ficha1-378x500-300x397.jpg");
$productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_MAIN);
$productImage->setSKU($productSKU);
$envelope->addMessage($productImage);

$productImage = new MwseXmlProductImage();
$productImage->setImageLocation("https://cdna.4imprint.com/prod/extras/006729/391089/700/1.jpg");
$productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_PT1);
$productImage->setSKU($productSKU);
$envelope->addMessage($productImage);

$productImage = new MwseXmlProductImage();
$productImage->setImageLocation("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzOiYJ0EikZBENCRvP1zV8Cxd2IJgroRKUaUB7MSq4Jvr_cUCE");
$productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_PT2);
$productImage->setSKU($productSKU); 
$envelope->addMessage($productImage);     

switch($subAction) {
  case "Exec":
    header("Content-Type: text/plain");
    $feedContent = $envelope->getXML();
    $feedRequest = [
      'marketplaceId' => 'APJ6JRA9NG5V4',
      'feed' => $feedContent
    ];
    
    $feedResponse = $client->submitImages($feedRequest);
    $productFeed = new FeedSubmissionData();
    $productFeed->setSubmissionId($feedResponse->getSubmitFeedResult()->getFeedSubmissionInfo()->getFeedSubmissionId());
    $productFeed->setStatus(FeedSubmissionData::PENDING);
    $productFeed->setRequest($feedRequest);
    $productFeed->setResponse($feedResponse);
    $productFeed->setField("crc32", crc32($feedRequest['feed']));
    $productFeedDataManager->create($productFeed);

    print_r($feedResponse);
    break;   
  case "Default":
  default:
    header("Content-Type: text/xml");
    print $envelope->getXML();
    break;
}