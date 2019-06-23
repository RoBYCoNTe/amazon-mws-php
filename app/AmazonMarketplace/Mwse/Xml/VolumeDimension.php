<?php 

require_once "VolumeUnitOfMeasure.php";

class MwseXmlVolumeDimension {
  private $_data = [
    '_value' => null,
    '_attributes' => [
      'unitOfMeasure' => null
    ]
  ];


  function __construct($value, MwseXmlVolumeUnitOfMeasure $unit) {
    $this->_data['_value'] = "$value";
    $this->_data['_attributes']['unitOfMeasure'] = $unit->getValue();
  }

  public function getData() {
    return $this->_data;
  }

  public static function create($value, MwseXmlVolumeUnitOfMeasure $unit) {
    return new MwseXmlVolumeDimension($value, $unit);
  }
}