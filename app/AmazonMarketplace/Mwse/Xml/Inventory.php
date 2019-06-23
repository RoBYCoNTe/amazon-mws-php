<?php 
class MwseXmlInventory {
  private $_data = [
    'SKU' => null,
    'Quantity' => null,
    'Available' => null
  ];

  public function setSKU($value) {
    $this->_data['SKU'] = $value;
    return $this;
  }

  public function setQuantity($value) {
    $this->_data['Quantity'] = $value;
    return $this;
  }

  public function setAvailable($value) {
    if (is_null($value)) {
      $this->_data['Available'] = null;
      return $this;
    }
    $this->_data['Available'] = $value ? "true" : "false";
    return $this;
  }

  public function getData() {
    $data = array_filter($this->_data);
    return ['Inventory' => $data];
  }
}