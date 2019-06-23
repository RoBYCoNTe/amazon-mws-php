<?php

/**
 * @author Roberto Conte Rosito <roberto.conterosito@gmail.com>
 */
class MwseConfig {
  private $serviceUrl = null;
  private $accessKeyId = null;
  private $secretAccessKey = null;
  private $accessToken = null;
  private $applicationName = null;
  private $applicationVersion = null;
  private $merchantId = null;
  
  public function getServiceUrl() {
    return $this->serviceUrl;
  }

  public function setServiceUrl($serviceUrl) {
    $this->serviceUrl = $serviceUrl;
  }

  public function getAccessKeyId() {
    return $this->accessKeyId;
  }
  public function setAccessKeyId($accessKeyId) {
    $this->accessKeyId = $accessKeyId;
  }
  public function getSecretAccessKey() {
    return $this->secretAccessKey;
  }
  public function setSecretAccessKey($secretAccessKey) {
    $this->secretAccessKey = $secretAccessKey;
  }
  public function getAccessToken() {
    return $this->accessToken;
  }
  public function setAccessToken($accessToken) {
    $this->accessToken = $accessToken;
  }
  public function getApplicationName() {
    return $this->applicationName;
  }
  public function setApplicationName($applicationName) {
    $this->applicationName = $applicationName;
  }
  public function getApplicationVersion() {
    return $this->applicationVersion;
  }
  public function setApplicationVersion($applicationVersion) {
    $this->applicationVersion = $applicationVersion;
  }
  public function getMerchantId() {
    return $this->merchantId;
  }
  public function setMerchantId($merchantId) {
    $this->merchantId = $merchantId;
  }

  function __construct($params) {
    $keys = array_keys($params);
    foreach($keys as $key) {
      // Sometimes we are stupid and we do not remember really well property names.
      // We are developer and we have no fucking life <3.
      if (property_exists($this, $key)) {
        $this->{$key} = $params[$key];
      }
      else {
        throw new Exception("Invalid config parameter: $key. What do you mean bro?");
      }
    }
  }

  public function validate() {
    $required = [
      'serviceUrl',
      'accessKeyId',
      'secretAccessKey',
      'accessToken',
      'merchantId'
    ];
    foreach($required as $param) {
      if (is_null($this->{$param}) || empty($this->{$param})) {
        throw new MwsException("Parameter required but not specified: $param");
      }
    }
    return $this;
  }
}