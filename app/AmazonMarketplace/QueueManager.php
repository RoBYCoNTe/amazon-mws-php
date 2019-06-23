<?php
abstract class AMQueueManager {
  private $_quotas = [];

  public abstract function getLogger();
  
  public abstract function enqueue(AMQueueItem $queueItem);
  
  public abstract function list($status, $size);

  public abstract function patch(AMQueueItem $queueItem);
  

  public function submit($size = 10) {
    $logger = $this->getLogger();
    $items = $this->list(AMQueueItem::STATUS_PENDING, $size);
    $count = count($items);
    $logger->verbose("Items to process: $count");
    if ($count === 0) {
      return;
    }
    foreach($items as $item) {
      if (!$this->canProcess($item, 'submit')) {
        $logger->warn("Quota reached for item: {$item->getId()}/{$item->getAccessToken()}");
        continue;
      }
      $this->submitItem($item);
    }
  }

  public function sync($size = 10) {
    $logger = $this->getLogger();
    
    $items = $this->list(AMQueueItem::STATUS_WORKING, $size);
    $count = count($items);
    $logger->verbose("Items to check: $count");
    if ($count === 0) {
      return;
    }
    foreach($items as $item) {
      if (!$this->canProcess($item, 'response')) {
        $logger->warn("Quota reached for item: {$item->getId()}");
        continue;
      }
      $this->syncItem($item);
    }
  }

  /**
   * Detect how many actions can be executed for every access token.
   * Suppose you have to process one product with many operation, for example 4:
   * - insert the product
   * - add price
   * - add stock units
   * - add images
   * 
   * You will needs 4 minutes to complete the process because you can execute one 
   * operation at time.
   *
   * @param AMQueueItem $item
   * @return boolean
   */
  private function canProcess(AMQueueItem $item, $type) {
    if (!isset($this->_quotas[$type])) {
      $this->_quotas[$type] = [];
    }
    if (!isset($this->_quotas[$type][$item->getAction()])) {
      $this->_quotas[$type][$item->getAction()] = [];
    }
    if (!isset($this->_quotas[$type][$item->getAction()][$item->getAccessToken()])) {
      $this->_quotas[$type][$item->getAction()][$item->getAccessToken()] = 0;
    }
    $this->_quotas[$type][$item->getAction()][$item->getAccessToken()]++;

    return $this->_quotas[$type][$item->getAction()][$item->getAccessToken()] <= 1;
  }

  private function submitItem(AMQueueItem $item) {
    try {
      $client = $this->createClient($item);
      $request = [
        'feed' => $item->getFeed(),
        'marketplaceId' => $item->getMarketplaceId()
      ];
      
      $this->getLogger()->verbose("Submitting action={$item->getAction()}, marketplaceId={$item->getMarketplaceId()}");

      $response = $client->{$item->getAction()}($request);
      $item->setStatus(AMQueueItem::STATUS_WORKING);
      $item->setSubmissionId($response->getSubmitFeedResult()->getFeedSubmissionInfo()->getFeedSubmissionId());

      $this->getLogger()->verbose("Patching the submission queue item with submission id={$item->getSubmissionId()}");

      $this->patch($item);
    }
    catch(Error $e) {
      $item->setStatus(AMQueueItem::STATUS_ERROR);
      $item->setMessage($e->getMessage());
      $this->patch($item);
    }
  }

  private function syncItem(AMQueueItem $item) {
    try {
      $client = $this->createClient($item);
      $result = $client->getFeedSubmissionResult([
        'feedSubmissionId' => $item->getSubmissionId()
      ]);
      $message = implode(" - ", [
        $result['result_code'],
        $result['result_message_code'],
        $result['result_description']
      ]);
      $item->setMessage($message);
      $item->setStatus($result['successful'] ? AMQueueItem::STATUS_COMPLETED : AMQueueItem::STATUS_FAILED);
      $this->patch($item);
    }
    catch(MarketplaceWebService_Exception $e) {
      $item->setMessage($e->getMessage());
      $this->patch($item);
    }
    catch(Error $e) {
      $item->setStatus(AMQueueItem::STATUS_ERROR);
      $item->setMessage($e->getMessage());
      $this->patch($item);
    }
  }

  private function createClient(AMQueueItem $item) {
    $config = new MwseConfig([
      'serviceUrl' => $item->getServiceURL(),
      'accessKeyId' => $item->getAccessKeyId(),
      'secretAccessKey' => $item->getSecretAccessToken(),
      'accessToken' => $item->getAccessToken(),
      'merchantId' => $item->getMerchantId(),
      'applicationName' => 'TEST APP',
      'applicationVersion' => '1.0'
    ]);  
    return new MwseClient($config);
  }
}