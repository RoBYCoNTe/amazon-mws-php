<?php 

require_once "ClothingSizeUnitOfMeasure.php";

class MwseXmlProductDataClothingSizeDimension {
  private $_data = [
    '_value' => null,
    '_attributes' => [
      'unitOfMeasure' => null
    ]
  ];


  function __construct($value, MwseXmlProductDataClothingSizeUnitOfMeasure $unit) {
    $this->_data['_value'] = "$value";
    $this->_data['_attributes']['unitOfMeasure'] = $unit->getValue();
  }

  public function getData() {
    return $this->_data;
  }

  public static function create($value, MwseXmlProductDataClothingSizeUnitOfMeasure $unit) {
    return new MwseXmlProductDataClothingSizeDimension($value, $unit);
  }
}