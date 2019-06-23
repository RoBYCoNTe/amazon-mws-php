<?php

class MwseXmlVolumeUnitOfMeasure {
  const CUBIC_CM = "cubic-cm";
  const CUBIC_FT = "cubic-ft";
  const CUBIC_IN = "cubic-in";
  const CUBIC_M = "cubic-m";
  const CUBIC_YD = "cubic-yd";
  const CUP = "cup";
  const FLUID_OZ = "fluid-oz";
  const GALLON = "gallon";
  const LITER = "liter";
  const MILLIMETER = "milliliter";
  const OUNCE = "ounce";
  const PINT = "pint";
  const QUART = "quart";

  private $_value = null;

  function __construct($unit) {
    $this->_value = $unit;
  }

  public function getValue() {
    return $this->_value;
  }

  private static function get($unit) {
    return new MwseXmlVolumeUnitOfMeasure($unit);
  }

  public static function getCubicCm() {
    return self::get(self::CUBIC_CM);
  }

  public static function getCubicFt() {
    return self::get(self::CUBIC_FT);
  }

  public static function getCubicIn() {
    return self::get(self::CUBIC_IN);
  }

  public static function getCubicM() {
    return self::get(self::CUBIC_M);
  }

  public static function getCubicYd() {
    return self::get(self::CUBIC_YD);
  }

  public static function getCup() {
    return self::get(self::CUP);
  }

  public static function getFluidOz() {
    return self::get(self::FLUID_OZ);
  }

  public static function getGallon() {
    return self::get(self::GALLON);
  }

  public static function getLiter() {
    return self::get(self::LITER);
  }

  public static function getMillimeter() {
    return self::get(self::MILLIMETER);
  }

  public static function getOunce() {
    return self::get(self::OUNCE);
  }

  public static function getPint() {
    return self::get(self::PINT);
  }

  public static function getQuart() {
    return self::get(self::QUART);
  }
}