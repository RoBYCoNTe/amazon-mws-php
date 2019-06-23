<?php

require_once ("CurrencyAmount.php");

class MwseXmlPrice {
  private $_data = [
    'SKU' => null,
    'StandardPrice' => null
  ];

  public function setSKU($value) {
    $this->_data['SKU'] = $value;
    return $this;
  }

  public function setStandardPrice(MwseXmlCurrencyAmount $value) {
    $this->_data['StandardPrice'] = $value->getData();
  }

  public function getData() {
    $data = array_filter($this->_data);
    return ['Price' => $data];
  }
}