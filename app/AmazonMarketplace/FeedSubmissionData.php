<?php 

/**
 * Represents basic class to encapsulate product creation/update requests. 
 */
class FeedSubmissionData {
  const PENDING = "pending";
  const CREATED = "created";
  const FAILED = "failed";

  private $_submissionId;
  private $_request;
  private $_response;
  private $_status;
  private $_fields = [];
  
  function __construct() {
    $this->_submissionId = null;
    $this->_fields = [];
    $this->_status = self::PENDING;
    $this->_request = null;
    $this->_response = null;
  }

  public function setSubmissionId($submissionId) {
    $this->_submissionId = $submissionId;
    return $this;
  }

  public function getSubmissionId() {
    return $this->_submissionId;
  }

  public function setRequest($request) {
    $this->_request = $request;
    return $this;
  }

  public function getRequest() {
    return $this->_request;
  }

  public function setResponse($response) {
    $this->_response = $response;
    return $this;
  }

  public function getResponse() {
    return $this->_response;
  }

  public function setStatus($status) {
    $this->_status = $status;
    return $this;
  }

  public function getStatus() {
    return $this->_status;
  }

  public function setFields(Array $fields) {
    $this->_fields = $fields;
    return $this;
  }

  public function getFields() {
    return $this->_fields;
  }

  public function setField($name, $value) {
    $this->_fields[$name] = $value;
    return $this;
  }

  public function getField($name) {
    return isset($this->_fields[$name]) ? $this->_fields[$name] : null;
  }

  public function setData(Array $data) {
    if (isset($data['submission_id'])) {
      $this->_submissionId = $data['submission_id'];
    }
    if (isset($data['request'])) {
      $this->_request = $data['request'];
    }
    if (isset($data['response'])) {
      $this->_response = $data['response'];
    }
    if (isset($data['status'])) {
      $this->_status = $data['status'];
    }
    if (isset($data['fields'])) {
      $this->_fields = $data['fields'];
    }
  }

  public function getData() {
    return [
      'submission_id' => $this->_submissionId,
      'request' => json_encode($this->_request),
      'response' => json_encode($this->_response),
      'status' => $this->_status,
      'fields' => $this->_fields
    ];  
  }

  public function hasMatch(FeedSubmissionData $item, $matchType = "OR") {
    $filters = 0;
    $matches = 0;
    if (!is_null($this->_status)) {
      $filters++;
      $matches+= $this->_status === $item->getStatus() ? 1 : 0;
    }
    if (!is_null($this->_submissionId)) {
      $filters++;
      $matches+= $this->_submissionId === $item->getSubmissionId() ? 1 : 0;
    }
    if (count($this->_fields) > 0) {
      foreach($this->_fields as $name => $value) {
        $filters++;
        $matches+= $item->getField($name) === $value;
      }
    }
    if ($filters === 0) {
      return TRUE;
    }

    return $matchType === "OR" ? $matches > 0 : $matches === $filters;
  }
}