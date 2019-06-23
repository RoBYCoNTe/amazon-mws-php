<?php 

$productFeedCriteria = new FeedSubmissionData();
$productFeedCriteria->setStatus(FeedSubmissionData::PENDING);
$productFeedPendings = $productFeedDataManager->retrieve($productFeedCriteria);

header("Content-Type: text/plain");
if (count($productFeedPendings) === 0) {
  print ("Oops! There's not data to process, try again later or push new feeds");
}
foreach($productFeedPendings as $pendingFeed) {
  $feedResult = $client->getFeedSubmissionResult(['feedSubmissionId' => $pendingFeed->getSubmissionId()]);
  
  $pendingFeed->setField("result_code", $feedResult['result_code']);
  $pendingFeed->setField("result_message_code", $feedResult['result_message_code']);
  $pendingFeed->setField("result_description", $feedResult['result_description']);
  $pendingFeed->setStatus($feedResult['successful'] ? FeedSubmissionData::CREATED : FeedSubmissionData::FAILED);
  $productFeedDataManager->update($pendingFeed);

  print implode(" - ", [
    $pendingFeed->getSubmissionId(),
    $pendingFeed->getStatus(),
    $feedResult['result_code'],
    $feedResult['result_description']
  ]);
  
  print PHP_EOL;
}