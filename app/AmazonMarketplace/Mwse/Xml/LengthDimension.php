<?php 

require_once ("LengthUnitOfMeasure.php");

class MwseXmlLengthDimension {
  const LENGTH = "Length";
  const WIDTH = "Width";
  const HEIGHT = "Height";
  const WEIGHT = "Weight";

  private $_data = [
    '_value' => null,
    '_attributes' => [
      'unitOfMeasure' => null
    ]
  ];

  function __construct($value, MwseXmlLengthUnitOfMeasure $unit) {
    $this->_data['_value'] = "$value";
    $this->_data['_attributes']['unitOfMeasure'] = $unit->getValue();
  }

  public function getData() {
    return $this->_data;
  }

  public static function create($value, MwseXmlLengthUnitOfMeasure $unit) {
    return new MwseXmlLengthDimension($value, $unit);
  }
}