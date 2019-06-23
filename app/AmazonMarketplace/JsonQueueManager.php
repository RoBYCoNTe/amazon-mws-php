<?php 
class AMJsonQueueManager extends AMQueueManager {
  private $_memoryPath = "Queue.json";
  
  private $_logger = null;

  public function getLogger() {
    if (is_null($this->_logger)) {
      $this->_logger = new AMEchoLogger();
    }
    return $this->_logger;
  }

  public function enqueue(AMQueueItem $item) {
    $list = $this->_get();
    
    $this->getLogger()->verbose("Queue items before enqueue: " . count($list));
    
    $item->setId(uniqid());
    $equals = array_filter($list, function($rawItem) use ($item) {
      return $rawItem['crc32'] === $item->getCrc32() && 
        (
          $rawItem['status'] === AMQueueItem::STATUS_PENDING || 
          $rawItem['status'] === AMQueueItem::STATUS_WORKING
        );
    });
    if (count($equals) > 0) {
      $this->getLogger()->warn("Queue item skipped because already added (and pending too!).");
      return;
    }
    
    array_push($list, $item->getData());
    $this->_set($list);

    $this->getLogger()->verbose("Queue items after insert: count=" . count($list));
    $this->getLogger()->verbose("Added new item in queue: id={$item->getId()}, action={$item->getAction()}");
  }
  
  public function list($status, $size) {
    $list = $this->_get();
    $list = array_values(array_filter($list, function($rawItem) use ($status) {
      return $rawItem['status'] === $status;
    }));
    if (count($list) < $size) {
      return $this->_map($list);
    }
    
    $chunks = array_chunk($list, $size);
    return $this->_map($chunks[0]);
  }

  public function patch(AMQueueItem $item) {
    $list = $this->_get();
    $matches = array_filter($list, function($rawItem) use ($item) {
      return $rawItem['id'] === $item->getId();
    });
    if (count($matches) !== 1) {
      $this->getLogger()->error("Unable to locate queue item: id={$item->getId()}, action={$item->getAction()}");
      return;
    }

    $list = array_values(array_filter($list, function($rawItem) use ($item) {
      return $rawItem['id'] !== $item->getId();
    }));
    $item->setModified(new DateTime());
    $list[] = $item->getData();
    
    $this->_set($list);
    $count = count($list);
    $this->getLogger()->verbose("Updated $count items.");
  }

  private function _map($list) {
    return array_map(function($rawItem) {
      $item = new AMQueueItem();
      $item->setData($rawItem);
      return $item;
    }, $list);
  }
  private function _get() {
    if (!file_exists($this->_memoryPath)) {
      return [];
    }
    $rawText = file_get_contents($this->_memoryPath);
    $records = json_decode($rawText, TRUE);
    if (is_null($records) || empty($records)) {
      return [];
    }
    return $records;
  }

  private function _set($list) {
    $count = count($list);
    $this->getLogger()->info("Updating JSON database: $count rows.");
    unlink($this->_memoryPath);
    file_put_contents($this->_memoryPath, json_encode($list, JSON_PRETTY_PRINT));
  }  
}