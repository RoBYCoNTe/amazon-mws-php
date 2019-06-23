<?php
require_once "ClothingVariationData.php";
require_once "ClothingClassificationData.php";

class MwseXmlProductDataClothing {
  private $_variationData;
  private $_classificationData;

  /**
   * @return MwseXmlProductDataClothingVariationData
   */
  public function getVariationData() {
    if (is_null($this->_variationData)) {
      $this->_variationData = new MwseXmlProductDataClothingVariationData($this);
    }
    return $this->_variationData;
  }

  /**
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function getClassificationData() {
    if (is_null($this->_classificationData)) {
      $this->_classificationData = new MwseXmlProductDataClothingClassificationData($this);
    }
    return $this->_classificationData;
  }

  public function getData() {
    $data = [
      'VariationData' => is_null($this->_variationData) 
        ? null 
        : $this->_variationData->getData(),
      'ClassificationData' => is_null($this->_classificationData) 
        ? null 
        : $this->_classificationData->getData()
    ];
    return ['Clothing' => $data];
  }

  public static function create() {
    return new MwseXmlProductDataClothing();
  }
}