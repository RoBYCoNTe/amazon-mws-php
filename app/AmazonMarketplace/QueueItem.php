<?php 
/**
 * Represents basic object to implement when you want to work with Amazon Queue Items.
 */
class AMQueueItem {
  /**
   * Indicates items to be processed.
   */
  const STATUS_PENDING = 'pending';
  /**
   * Indicates items sent to amazon pending callback. 
   */
  const STATUS_WORKING = 'working';
  /**
   * Indicates items failed.
   */
  const STATUS_FAILED = 'failed';
  /**
   * Indicates items with internal server errors.
   */
  const STATUS_ERROR = 'error';
  /**
   * Indicates items completed with success.
   */
  const STATUS_COMPLETED = 'completed';
  
  const ACTION_SUBMIT_PRODUCT = "submitProduct";
  const ACTION_SUBMIT_IMAGES = "submitImages";
  const ACTION_SUBMIT_RELATIONSHIP = "submitRelationship";
  const ACTION_LIST_ORDERS = "listOrders";

  const ACTION_SUBMIT_INVENTORY = "submitInventory";
  const ACTION_SUBMIT_PRICE = "submitPrice";
  
  // const ACTION_UPDATE_PROCESSING_FEEDS = "";

  private $_data = [
    'id' => null,
    'action' => null,
    'status' => 'pending',
    'message' => null,
    'feed' => null,
    'marketplace_id' => null,
    'service_url' => null,
    'access_key_id' => null,
    'secret_access_key' => null,
    'access_token' => null,
    'merchant_id' => null,
    'submission_id' => null,
    'crc32' => null,
    'created' => null,
    'modified' => null
  ];

  function __construct() {
    
  }

  public function setId($value) {
    $this->_data['id'] = $value;
    return $this;
  }
  public function getId() {
    return $this->_data['id'];
  }
  public function setAction($value) {
    $this->_data['action'] = $value;
    return $this;
  }
  public function getAction() {
    return $this->_data['action'];
  }
  public function setStatus($value) {
    $this->_data['status'] = $value;
    return $this;
  }
  public function getStatus() {
    return $this->_data['status'];
  }
  public function setMessage($value) {
    $this->_data['message'] = $value;
    return $this;
  }
  public function getMessage() {
    return $this->_data['message'];
  }
  public function setFeed(String $value) {
    $this->_data['feed'] = $value;
    return $this;
  }
  public function getFeed() {
    return $this->_data['feed'];
  }
  public function setMarketplaceId($value) {
    $this->_data['marketplace_id'] = $value;
    return $this;
  }
  public function getMarketplaceId() {
    return $this->_data['marketplace_id'];
  }
  public function setServiceURL($value) {
    $this->_data['service_url'] = $value;
    return $this;
  }
  public function getServiceURL() {
    return $this->_data['service_url'];
  }
  public function setAccessKeyId($value) {
    $this->_data['access_key_id'] = $value;
    return $this;
  }
  public function getAccessKeyId() {
    return $this->_data['access_key_id'];
  }
  public function setSecretAccessToken($value) {
    $this->_data['secret_access_token'] = $value;
    return $this;
  }
  public function getSecretAccessToken() {
    return $this->_data['secret_access_token'];
  }
  public function setAccessToken($value) {
    $this->_data['access_token'] = $value;
    return $this;
  }
  public function getAccessToken() {
    return $this->_data['access_token'];
  }
  public function setMerchantId($value) {
    $this->_data['merchant_id'] = $value;
    return $this;
  }
  public function getMerchantId() {
    return $this->_data['merchant_id'];
  }
  public function setSubmissionId($value) {
    $this->_data['submission_id'] = $value;
    return $this;
  }
  public function getSubmissionId() {
    return $this->_data['submission_id'];
  }
  public function setCrc32($value) {
    $this->_data['crc32'] = $value;
    return $this;
  }
  public function getCrc32() {
    return $this->_data['crc32'];
  }
  public function setCreated(DateTime $date) {
    $this->_data['created'] = $date->format('Y-m-d H:i:s');
    return $this;
  }
  public function getCreated() {
    return date_create_from_format('Y-m-d H:i:s', $this->_data['created']);
  }
  public function setModified(DateTime $date) {
    $this->_data['modified'] = $date->format('Y-m-d H:i:s');
    return $this;
  }
  public function getModified() {
    if (!is_null($this->_data['modified'])) 
      return date_create_form_format('Y-m-d H:i:s', $this->_data['modified']);
    return null;
  }

  public function getData() {
    return $this->_data;
  }

  public function setData($data) {
    $this->_data = $data;
  }

  public function setConfig(Array $config) {
    $this->setServiceURL($config['service_url']);
    $this->setAccessKeyId($config['access_key_id']);
    $this->setSecretAccessToken($config['secret_access_key']);
    $this->setAccessToken($config['access_token']);
    $this->setMerchantId($config['merchant_id']);
  }

  public static function submitProduct(String $marketplaceId, String $feed, Array $config) {
    $item = new AMQueueItem();
    $item->setMarketplaceId($marketplaceId);
    $item->setFeed($feed);
    $item->setConfig($config);
    $item->setAction(self::ACTION_SUBMIT_PRODUCT);
    $item->setStatus(self::STATUS_PENDING);
    $item->setCreated(new DateTime());
    
    return $item;
  }

  public static function submitImages(String $marketplaceId, String $feed, Array $config) {
    $item = new AMQueueItem();
    $item->setMarketplaceId($marketplaceId);
    $item->setFeed($feed);
    $item->setConfig($config);
    $item->setAction(self::ACTION_SUBMIT_IMAGES);
    $item->setStatus(self::STATUS_PENDING);
    $item->setCreated(new DateTime());

    return $item;
  }

  public static function submitRelationship(String $marketplaceId, String $feed, Array $config) {
    $item = new AMQueueItem();
    $item->setMarketplaceId($marketplaceId);
    $item->setFeed($feed);
    $item->setConfig($config);
    $item->setAction(self::ACTION_SUBMIT_RELATIONSHIP);
    $item->setStatus(self::STATUS_PENDING);
    $item->setCreated(new DateTime());

    return $item;
  }

  public static function submitInventory(String $marketplaceId, String $feed, Array $config) {
    $item = new AMQueueItem();
    $item->setMarketplaceId($marketplaceId);
    $item->setFeed($feed);
    $item->setConfig($config);
    $item->setAction(self::ACTION_SUBMIT_INVENTORY);
    $item->setStatus(self::STATUS_PENDING);
    $item->setCreated(new DateTime());

    return $item;
  }

  public static function submitPrice(String $marketplaceId, String $feed, Array $config)  {
    $item = new AMQueueItem();
    $item->setMarketplaceId($marketplaceId);
    $item->setFeed($feed);
    $item->setConfig($config);
    $item->setAction(self::ACTION_SUBMIT_PRICE);
    $item->setStatus(self::STATUS_PENDING);
    $item->setCreated(new DateTime());

    return $item;
  }
}