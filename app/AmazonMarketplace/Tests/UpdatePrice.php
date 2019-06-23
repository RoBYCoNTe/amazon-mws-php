<?php 
// Update existing product's price. 
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("Price");
$price = new MwseXmlPrice();
$price->setSKU($productSKU);
$price->setStandardPrice(MwseXmlCurrencyAmount::create("10", MwseXmlCurrencyCode::getEUR()));
$envelope->addMessage($price);

switch($subAction) {
  case "Exec":
    // Send request to MWS to update the price.
    header("Content-Type: text/plain");
    $feedContent = $envelope->getXML();
    $feedRequest = [
      'marketplaceId' => 'APJ6JRA9NG5V4',
      'feed' => $feedContent
    ];
    
    $feedResponse = $client->submitPrice($feedRequest);
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
    // Just print the output generated from XML (for DEBUG).
    header("Content-Type: text/xml");
    print $envelope->getXML();
    break;
}