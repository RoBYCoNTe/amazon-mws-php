<?php
class MwseXmlProductDataClothingSizeUnitOfMeasure {
  const IN = "IN";
  const CM = "CM";
  
  private $_value;

  function __construct($unit) {
    $this->_value = $unit;    
  }

  public function getValue() {
    return $this->_value;
  }

  private static function get($unit) {
    return new MwseXmlProductDataClothingSizeUnitOfMeasure($unit);
  }

  public static function getIn() {
    return self::get(self::IN);
  }

  public static function getCm() {
    return self::get(self::CM);
  }

}