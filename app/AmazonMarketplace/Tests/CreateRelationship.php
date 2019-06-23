<?php 
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMerchantIdentifier("MERCHANTID");
$envelope->setMessageType("Relationship");

$relationship = new MwseXmlRelationship();
$relationship->setParentSKU($_GET['ParentSKU']);
$variations = explode(",", $_GET['VariationSKU']);
foreach($variations as $variation) {
  $relationship->addRelation($variation, MwseXmlRelationship::RELATION_TYPE_VARIATION);
}
$envelope->addMessage($relationship);

switch($subAction) {
  case "Exec":
    $request = ['marketplaceId' => $marketplaceId, 'feed' => $envelope->getXML()];
    $response = $client->submitRelationship($request);
    enqueue_feed_request($request, $response);
    break;
  default:
    header("Content-Type: text/xml");
    print $envelope->getXML();
    break;
}