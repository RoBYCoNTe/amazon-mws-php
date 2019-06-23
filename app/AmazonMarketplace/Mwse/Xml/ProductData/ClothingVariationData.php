<?php

class MwseXmlProductDataClothingVariationData {
  const PARENTAGE_PARENT = "parent";
  const PARENTAGE_CHILD = "child";
  
  const VARIATION_THEME_SIZE = "Size";
  const VARIATION_THEME_COLOR = "Color";
  const VARIATION_THEME_SIZE_COLOR = "SizeColor";
  const VARIATION_THEME_COLOR_ITEMPACKAGEQUANTITY = "Color-Itempackagequantity";
  const VARIATION_THEME_COLOR_MATERIAL = "Color-Material";
  const VARIATION_THEME_COLOR_PATTERNNAME = "Color-Patternname";
  const VARIATION_THEME_COLOR_SIZE = "ColorSize";
  const VARIATION_THEME_ITEMPACKAGEQUANTITY = "Itempackagequantity";
  const VARIATION_THEME_ITEMPACKAGEQUANTITY_COLOR = "Itempackagequantity-Color";
  const VARIATION_THEME_ITEMPACKAGEQUANTITY_MATERIAL = "Itempackagequantity-Material";
  const VARIATION_THEME_ITEMPACKAGEQUANTITY_SIZE = "Itempackagequantity-Size";
  const VARIATION_THEME_MATERIAL = "Material";
  const VARIATION_THEME_MATERIAL_COLOR ="Material-Color";
  const VARIATION_THEME_MATERIAL_PATTERNNAME = "Material-Patternname";
  const VARIATION_THEME_MATERIAL_SIZE = "Material-Size";
  const VARIATION_THEME_PATTERNNAME = "Patternname";
  const VARIATION_THEME_PATTERNNAME_COLOR = "Patternname-Color";
  const VARIATION_THEME_PATTERNNAME_MATERIAL = "Patternname-Material";
  const VARIATION_THEME_PATTERNNAME_SIZE = "Patternname-Size";
  const VARIATION_THEME_SIZE_MATERIAL = "Size-Material";
  const VARIATION_THEME_SIZE_PATTERNNAME = "Size-Patternname";
  const VARIATION_THEME_CUPSIZE = "Cupsize";
  const VARIATION_THEME_CUPSIZE_COLOR = "Cupsize-Color";
  const VARIATION_THEME_CUPSIZE_COLOR_SIZE = "Cupsize-Color-Size";
  const VARIATION_THEME_CUPSIZE_SIZE = "Cupsize-Size";

  private $_data = [
    'Parentage' => null,
    'Size' => null,
    'Color' => null,
    'VariationTheme' => null
  ];
  private $_clothing;

  function __construct(MwseXmlProductDataClothing $clothing) {
    $this->_clothing = $clothing;
  }

  /**
   * @param String $value MwseXmlProductDataClothingVariationData::PARENTAGE_*
   * @return MwseXmlProductDataClothingVariationData
   */
  public function setParentage($value) {
    $this->_data['Parentage'] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingVariationData
   */
  public function setSize($value) {
    $this->_data['Size'] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingVariationData
   */
  public function setColor($value) {
    $this->_data['Color'] = $value;
    return $this;
  }

  /**
   * @param String $value MwseXmlProductDataClothingVariationData::VARIATION_THEME_*
   * @return MwseXmlProductDataClothingVariationData
   */
  public function setVariationTheme($value) {
    $this->_data['VariationTheme'] = $value;
    return $this;
  }

  public function getData() {
    return array_filter($this->_data);
  }

  public function getClothing() {
    return $this->_clothing;
  }
}