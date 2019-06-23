<?php
class MwseXmlProductImage {
  private $_data = [
    'SKU' => null,
    'ImageType' => null,
    'ImageLocation' => null
  ];

  const IMAGE_TYPE_MAIN = "Main";
  const IMAGE_TYPE_SWATCH  = "Swatch";
  const IMAGE_TYPE_BKLB = "BKLB";
  const IMAGE_TYPE_PT1 = "PT1";
  const IMAGE_TYPE_PT2 = "PT2";
  const IMAGE_TYPE_PT3 = "PT3";
  const IMAGE_TYPE_PT4 = "PT4";
  const IMAGE_TYPE_PT5 = "PT5";
  const IMAGE_TYPE_PT6 = "PT6";
  const IMAGE_TYPE_PT7 = "PT7";
  const IMAGE_TYPE_PT8 = "PT8";
  const IMAGE_TYPE_SEARCH = "Search";
  const IMAGE_TYPE_PM01 = "PM01";
  const IMAGE_TYPE_MAIN_OFFER_IMAGE = "MainOfferImage";
  const IMAGE_TYPE_OFFER_IMAGE_1 = "OfferImage1";
  const IMAGE_TYPE_OFFER_IMAGE_2 = "OfferImage2";
  const IMAGE_TYPE_OFFER_IMAGE_3 = "OfferImage3";
  const IMAGE_TYPE_OFFER_IMAGE_4 = "OfferImage4";

  private $_operationType = "Update";

  public function setSKU($value) {
    $this->_data["SKU"] = $value;
    return $this;
  }

  /**
   * @param String $value MwseXmlProductImage::IMAGE_TYPE_*
   * @return MwseXmlProductImage
   */
  public function setImageType($value) {
    $this->_data["ImageType"] = $value;
    return $this;
  }
  public function setImageLocation($value) {
    $this->_data["ImageLocation"] = $value;
    return $this;
  }

  public function getData() {
    return ['ProductImage' => $this->_data];
  }

  public function getOperationType() {
    return $this->_operationType;
  }
  public function setOperationType($value) {
    $this->_operationType = $value;
    return $this;
  }
}