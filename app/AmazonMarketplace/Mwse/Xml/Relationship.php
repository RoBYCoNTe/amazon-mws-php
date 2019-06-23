<?php 
class MwseXmlRelationship {
  
  const RELATION_TYPE_VARIATION = "Variation";
  const RELATION_TYPE_DISPLAY_SET = "DisplaySet";
  const RELATION_TYPE_COLLECTION = "Collection";
  const RELATION_TYPE_ACCESSORY = "Accessory";
  const RELATION_TYPE_CUSTOMIZED = "Customized";
  const RELATION_TYPE_PART = "Part";
  const RELATION_TYPE_COMPLEMENTS = "Complements";
  const RELATION_TYPE_PIECES = "Piece";
  const RELATION_TYPE_NECESSARY = "Necessary";
  const RELATION_TYPE_REPLACEMENT_PART = "ReplacementPart";
  const RELATION_TYPE_SIMILAR = "Similar";
  const RELATION_TYPE_EPISODE = "Episode";
  const RELATION_TYPE_SEASON = "Season";
  const RELATION_TYPE_MERCHANT_TITLE_AUTHORITY = "MerchantTitleAuthority";
  const RELATION_TYPE_COMPONENT = "Component";

  private $_data = [
    'ParentSKU' => null,
    'Relation' => []
  ];


  public function setParentSKU($value) {
    $this->_data['ParentSKU'] = $value;
    return $this;
  }

  /**
   * @param String $sku
   * @param String $type MwseXmlRelationship::RELATION_TYPE_*
   * @return void
   */
  public function addRelation($sku, $type) {
    $this->_data['Relation'][] = ['SKU' => $sku, 'Type' => $type];
    return $this;
  }

  public function getData() {
    return ['Relationship' => $this->_data];
  }
}