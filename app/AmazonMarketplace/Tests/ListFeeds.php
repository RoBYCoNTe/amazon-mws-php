<?php 
$feedCriteria = new FeedSubmissionData();
$feedCriteria->setStatus(null);
$feedCriteria->setSubmissionId(isset($_GET['SubmissionId']) ? $_GET['SubmissionId'] : null);

$feeds = $productFeedDataManager->retrieve($feedCriteria);

header ("Content-Type: text/plain");
foreach($feeds as $feed) {
  print implode(" - ", [
    $feed->getSubmissionId(),
    $feed->getStatus(),
    $feed->getField("result_description")
  ]);
  print PHP_EOL;
}