<?php
require_once "CurrencyCode.php";

class MwseXmlCurrencyAmount {
  const USD = "USD";
  const GBP = "GBP";

  private $_data = [
    '_value' => null,
    '_attributes' => [
      'currency' => null
    ]
  ];

  function __construct($value, MwseXmlCurrencyCode $currencyCode) {
    $this->_data['_value'] = "$value";
    $this->_data['_attributes']['currency'] = $currencyCode->getValue();
  }

  public function getData() {
    return $this->_data;
  }

  public static function create($value, MwseXmlCurrencyCode $currencyCode) {
    return new MwseXmlCurrencyAmount($value, $currencyCode);
  }
}