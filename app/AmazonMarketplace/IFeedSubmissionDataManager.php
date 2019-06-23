<?php 

require_once ("FeedSubmissionData.php");

interface IFeedSubmissionDataManager {
  
  public function create(FeedSubmissionData $feed);
  
  public function retrieve(FeedSubmissionData $criteria);
  
  public function update(FeedSubmissionData $feed);

  public function delete(FeedSubmissionData $feed);
  
}