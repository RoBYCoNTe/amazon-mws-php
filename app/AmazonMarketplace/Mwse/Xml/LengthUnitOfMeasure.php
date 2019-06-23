<?php

class MwseXmlLengthUnitOfMeasure {
  const MM = "MM";
  const CM = "CM";
  const M = "M";
  const IN = "IN";
  const FT = "FT";

  private $_value = null;

  function __construct($unit) {
    $this->_value = $unit;
  }

  public function getValue() {
    return $this->_value;
  }

  private static function get($unit) {
    return new MwseXmlLengthUnitOfMeasure($unit);
  }

  public static function getMm() {
    return self::get(self::MM);
  }
  public static function getCm() {
    return self::get(self::CM);
  }
  public static function getM() {
    return self::get(self::M);
  }
  public static function getIN() {
    return self::get(self::IN);
  }
  public static function getFT() {
    return self::get(self::FT);
  }
}