<?php 
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("Inventory");
$inventory = new MwseXmlInventory();
$inventory->setSKU($productSKU);
$inventory->setQuantity(10);

$envelope->addMessage($inventory);
switch($subAction) {
  case "Exec":
    header("Content-Type: text/plain");
    $feedContent = $envelope->getXML();
    $feedRequest = [
      'marketplaceId' => 'APJ6JRA9NG5V4',
      'feed' => $feedContent
    ];
    
    $feedResponse = $client->submitInventory($feedRequest);
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