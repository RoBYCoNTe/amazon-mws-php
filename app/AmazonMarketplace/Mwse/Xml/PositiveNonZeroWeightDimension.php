<?php
require_once "WeightUnitOfMeasure.php";

class MwseXmlPositiveNonZeroWeightDimension {
  private $_data = [
    '_value' => null,
    '_attributes' => [
      'unitOfMeasure' => null
    ]
  ];

  function __construct($value, MwseXmlWeightUnitOfMeasure $unit) {
    $this->_data['_value'] = "$value";
    $this->_data['_attributes']['unitOfMeasure'] = $unit->getValue();
  }

  public function getData() {
    return $this->_data;
  }

  public static function create($value, MwseXmlWeightUnitOfMeasure $unit) {
    return new MwseXmlPositiveNonZeroWeightDimension($value, $unit);
  }
}