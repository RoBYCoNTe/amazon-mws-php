<?php 
require_once __DIR__ . DIRECTORY_SEPARATOR . "../Exception.php";
require_once "Serializer.php";

class MwseXmlAmazonEnvelope {
  private $_data = [
    'Header' => [
      'DocumentVersion' => '1.01',
      'MerchantIdentifier' => ''
    ],
    'MessageType' => 'Product',
    'Message' => []
  ];

  public function setMerchantIdentifier($identifier) {
    $this->_data['Header']['MerchantIdentifier'] = $identifier;
  }

  public function setMessageType($messageType) {
    $this->_data['MessageType'] = $messageType;
  }

  public function getXML() {
    return Serializer::convert($this->_data, 'AmazonEnvelope');
  }

  public function addMessage($message) {
    $operationType = null;
    if (method_exists($message, 'getOperationType')) {
      $operationType = $message->getOperationType();
    }
    if (method_exists($message, "getData")) {
      $xmlMessage = array_merge([
        'MessageID' => count($this->_data['Message']) + 1,
        'OperationType' => $operationType
      ], $message->getData());
    }
    else if (is_array($message)) {
      $xmlMessage = array_merge([
        'MessageID' => count($this->_data['Message']) + 1,
        'OperationType' => $operationType
      ], $message);
    }
    else throw new MwseException("Unable to add specified message: invalid type.");
    
    $this->_data['Message'][] = array_filter($xmlMessage);
  }

  public function getData() {
    return $this->_data;
  }
}