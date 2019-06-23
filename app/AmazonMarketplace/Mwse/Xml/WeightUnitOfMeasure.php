<?php
class MwseXmlWeightUnitOfMeasure {
  const GR = "GR";
  const KG = "KG";
  const OZ = "OZ";
  const LB = "LB";
  const MG = "MG";

  private $_value;

  function __construct($unit) {
    $this->_value = $unit;    
  }

  public function getValue() {
    return $this->_value;
  }

  private static function get($unit) {
    return new MwseXmlWeightUnitOfMeasure($unit);
  }

  public static function getGR() {
    return self::get(self::GR);
  }
  public static function getKG() {
    return self::get(self::KG);
  }
  public static function getOZ() {
    return self::get(self::OZ);
  }
  public static function getLB() {
    return self::get(self::LB);
  }
  public static function getMG() {
    return self::get(self::MG);
  }
}