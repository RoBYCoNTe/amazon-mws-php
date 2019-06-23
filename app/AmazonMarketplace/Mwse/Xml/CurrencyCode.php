<?php
class MwseXmlCurrencyCode {
  const USD = "USD";
  const GBP = "GBP";
  const EUR = "EUR";
  const JPY = "JPY";
  const CAD = "CAD";
  const CNY = "CNY";

  private $_value = null;

  function __construct($currencyCode) {
    $this->_value = $currencyCode;
  }

  public function getValue() {
    return $this->_value;
  }

  private static function get($currencyCode) {
    return new MwseXmlCurrencyCode($currencyCode);
  }

  public static function getUSD() {
    return self::get(self::USD);
  }
  public static function getGBP() {
    return self::get(self::GBP);
  }
  public static function getEUR() {
    return self::get(self::EUR);
  }
  public static function getJPY() {
    return self::get(self::JPY);
  }
  public static function getCAD() {
    return self::get(self::CAD);
  }
  public static function getCNY() {
    return self::get(self::CNY);
  }
}