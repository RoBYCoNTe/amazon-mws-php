<?php
require_once ("IFeedSubmissionDataManager.php");

class FeedSubmissionJsonDataManager implements IFeedSubmissionDataManager {
  private $_memoryPath = "FeedSubmissionData.json";
  
  private function _get() {
    if (!file_exists($this->_memoryPath)) {
      return [];
    }
    $rawText = file_get_contents($this->_memoryPath);
    $records = json_decode($rawText, TRUE);
    return $records;
  }

  private function _set($list) {
    unlink($this->_memoryPath);
    file_put_contents($this->_memoryPath, json_encode($list, JSON_PRETTY_PRINT));
  }

  public function create(FeedSubmissionData $feed) {
    $list = $this->_get();
    $list[] = $feed->getData();
    $this->_set($list);
  }

  public function retrieve(FeedSubmissionData $criteria) {
    $list = $this->_get();
    $feeds = [];
    foreach($list as $item) {
      $feed = new FeedSubmissionData();
      $feed->setData($item);
      if ($criteria->hasMatch($feed)) {
        $feeds[] = $feed;
      }
    }
    return $feeds;
  }

  public function update(FeedSubmissionData $feed) {
    $feeds = $this->_get();
    $feeds = array_filter($feeds, function($feedRecord) use ($feed) {
      return $feedRecord['submission_id'] !== $feed->getSubmissionId();
    });
    $feeds[] = $feed->getData();
    $this->_set($feeds);
    return FALSE;
  }

  public function delete(FeedSubmissionData $feed) {
    $feeds = $this->_get();
    $feeds = array_filter($feeds, function($feedRecord) use ($feed) {
      return $feedRecord['submission_id'] !== $feed->getSubmissionId();
    });
    $this->_set($feeds);
  }
}