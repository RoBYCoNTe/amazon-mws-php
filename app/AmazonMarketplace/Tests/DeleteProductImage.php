<?php 
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("ProductImage");
$productImage = new MwseXmlProductImage();
$productImage->setSKU($productSKU);
$productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_PT1);
$productImage->setOperationType("Delete");
$envelope->addMessage($productImage);
switch($subAction) {
  case "Exec":
    $feedRequest = [
      'marketplaceId' => 'APJ6JRA9NG5V4',
      'feed' => $envelope->getXML()
    ];
    $feedResponse = $client->submitImages($feedRequest);
    $productFeed = new FeedSubmissionData();
    $productFeed->setSubmissionId($feedResponse->getSubmitFeedResult()->getFeedSubmissionInfo()->getFeedSubmissionId());
    $productFeed->setStatus(FeedSubmissionData::PENDING);
    $productFeed->setRequest($feedRequest);
    $productFeed->setResponse($feedResponse);
    $productFeed->setField("crc32", crc32($feedRequest['feed']));
    $productFeedDataManager->create($productFeed);

    header ("Content-Type: text/plain");
    print_r($feedResponse);
    break;
  case "Default":
  default:
    header("Content-Type: text/xml");
    print $envelope->getXML();
    break;
}