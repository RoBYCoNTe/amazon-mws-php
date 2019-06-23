<?php 

require_once __DIR__ . "/../LengthDimension.php";
require_once __DIR__ . "/../VolumeDimension.php";
require_once __DIR__ . "/../PositiveNonZeroWeightDimension.php";

require_once "ClothingSizeDimension.php";

class MwseXmlProductDataClothingClassificationData {
  const CLOTHING_TYPE_SHIRT ="Shirt";
  const CLOTHING_TYPE_SWEATER ="Sweater";
  const CLOTHING_TYPE_PANTS ="Pants";
  const CLOTHING_TYPE_SHORTS ="Shorts";
  const CLOTHING_TYPE_SKIRT ="Skirt";
  const CLOTHING_TYPE_DRESS ="Dress";
  const CLOTHING_TYPE_SUIT ="Suit";
  const CLOTHING_TYPE_BLAZER ="Blazer";
  const CLOTHING_TYPE_OUTERWEAR = "Outerwear";
  const CLOTHING_TYPE_SOCKs_HOSIERY ="SocksHosiery";
  const CLOTHING_TYPE_UNDERWEAR = "Underwear";
  const CLOTHING_TYPE_BRA = "Bra";
  const CLOTHING_TYPE_SHOES = "Shoes";
  const CLOTHING_TYPE_HAT = "Hat";
  const CLOTHING_TYPE_BAG = "Bag";
  const CLOTHING_TYPE_ACCESSORY = "Accessory";
  const CLOTHING_TYPE_JEWELRY = "Jewelry";
  const CLOTHING_TYPE_SLEEPWEAR = "Sleepwear";
  const CLOTHING_TYPE_SWIMWEAR = "Swimwear";
  const CLOTHING_TYPE_PERSONAL_BODY_CARE = "PersonalBodyCare";
  const CLOTHING_TYPE_HOME_ACCESSORY = "HomeAccessory";
  const CLOTHING_TYPE_NON_APPAREAL_MISC = "NonApparelMisc";
  const CLOTHING_TYPE_KIMONO = "Kimono";
  const CLOTHING_TYPE_OBI = "Obi";
  const CLOTHING_TYPE_CHANCHANKO = "Chanchanko";
  const CLOTHING_TYPE_JINBEI = "Jinbei";
  const CLOTHING_TYPE_YUKATA = "Yukata";
  const CLOTHING_TYPE_ETHNIC_WEAR = "EthnicWear";
  const CLOTHING_TYPE_COSTUME = "Costume";
  const CLOTHING_TYPE_ADULT_COSTUME = "AdultCostume";
  const CLOTHING_TYPE_BABY_COSTUME = "BabyCostume";
  const CLOTHING_TYPE_CHILDRENS_COSTUME = "ChildrensCostume";

  const PERFORMANCE_RATING_SUNPROOF = "Sunproof";
  const PERFORMANCE_RATING_WATERPROOF = "Waterproof";
  const PERFORMANCE_RATING_WEATERPROOF = "Weatherproof";
  const PERFORMANCE_RATING_WINDPROOF = "Windproof";

  const CUP_SIZE_A = "A";
  const CUP_SIZE_AA = "AA";
  const CUP_SIZE_B = "B";
  const CUP_SIZE_C = "C";
  const CUP_SIZE_D = "D";
  const CUP_SIZE_DD = "DD";
  const CUP_SIZE_DDD = "DDD";
  const CUP_SIZE_E = "E";
  const CUP_SIZE_EE = "EE";
  const CUP_SIZE_F = "F";
  const CUP_SIZE_FF = "FF";
  const CUP_SIZE_G = "G";
  const CUP_SIZE_GG = "GG";
  const CUP_SIZE_H = "H";
  const CUP_SIZE_I = "I";
  const CUP_SIZE_J = "J";
  const CUP_SIZE_FREE = "Free";

  const TARGET_GENDER_MALE = "male";
  const TARGET_GENDER_FEMALE = "female";
  const TARGET_GENDER_UNISEX = "unisex";

  const WATER_RESISTANCE_LEVEL_NOT_RESISTANT = "not_water_resistant";
  const WATER_RESISTANCE_LEVEL_RESISTANT = "water_resistant";
  const WATER_RESISTANCE_LEVEL_WATERPROOF = "waterproof";

  private $_data = [
    'BatteryAverageLife' => null,
    'BatteryAverageLifeStandby' => null,
    'BatteryChargeTime' => null,
    'Size' => null,
    'Color' => null,
    'ClothingType' => null,
    'Department' => null,
    'StyleKeywords' => null,
    'PlatinumKeywords' => null,
    'ColorMap' => null,
    'SpecialSizeType' => null,
    'MaterialAndFabric' => null,
    'ImportDesignation' => null,
    'CountryAsLabeled' => null,
    'FurDescription' => null,
    'MaterialComposition' => null,
    'MaterialOpacity' => null,
    'InnerMaterial' => null,
    'OuterMaterial' => null,
    'SoleMaterial' => null,
    'ShoeClosureType' => null,
    'ApparelClosureType' => null,
    'ClosureType' => null,
    'CareInstructions' => null,
    'OccasionAndLifestyle' => null,
    'EventKeywords' => null,
    'Season' => null,
    'SpecificUses' => null,
    'ExternalTestingCertification' => null,
    'PerformanceRating' => null,
    'ProductSpecification' => null,
    'Warnings' => null,
    'IsCustomizable' => "false",
    'CustomizableTemplateName' => null,
    'StyleName' => null,
    'CollarType' => null,
    'SleeveType' => null,
    'WaistStyle' => null,
    'MinimumHeightRecommended' => null,
    'MaximumHeightRecommended' => null,
    'CountryName' => null,
    'CountryOfOrigin' => null,
    'DisplayLength' => null,
    'DisplayVolume' => null,
    'DisplayWeight' => null,
    'ModelName' => null,
    'ModelNumber' => null,
    'ModelYear' => null,
    'IsAdultProduct' => null,
    'SizeMap' => null,
    'WaistSize' => null,
    'InseamLength' => null,
    'SleeveLength' => null,
    'NeckSize' => null,
    'ChestSize' => null,
    'CupSize' => null,
    'BraBandSize' => null,
    'ShoeWidth' => null,
    'HeelHeight' => null,
    'HeelType' => null,
    'ShaftHeight' => null,
    'ShaftDiameter' => null,
    'BeltLength' => null,
    'BeltWidth' => null,
    'BeltStyle' => null,
    'BottomStyle' => null,
    'ButtonQuantity' => null,
    'Character' => null,
    'ControlType' => null,
    'CuffType' => null,
    'FabricType' => null,
    'FabricWash' => null,
    'FitType' => null,
    'FrontPleatType' => null,
    'IncludedComponents' => null,
    'ItemRise' => null,
    'LaptopCapacity' => null,
    'LegDiameter' => null,
    'LegStyle' => null,
    'MaterialType' => null,
    'MfrWarrantyDescriptionLabor' => null,
    'MfrWarrantyDescriptionParts' => null,
    'MfrWarrantyDescriptionType' => null,
    'NeckStyle' => null,
    'Opacity' => null,
    'PatternStyle' => null,
    'CollectionName' => null,
    'FrameMaterialType' => null,
    'LensMaterialType' => null,
    'PolarizationType' => null,
    'LensWidth' => null,
    'LensHeight' => null,
    'BridgeWidth' => null,
    'PocketDescription' => null,
    'RegionOfOrigin' => null,
    'RiseStyle' => null,
    'SafetyWarning' => null,
    'SellerWarrantyDescription' => null,
    'SpecialFeature' => null,
    'TargetGender' => null,
    'Theme' => null,
    'TopStyle' => null,
    'UnderwireType' => null,
    'Volume' => null,
    'WaterResistanceLevel' => null,
    'WheelType' => null,
    'FurisodeLength' => null,
    'FurisodeWidth' => null,
    'ObiLength' => null,
    'ObiWidth' => null,
    'TsukeobiWidth' => null,
    'TsukeobiHeight' => null,
    'PillowSize' => null,
    'StrapType' => null,
    'ToeShape' => null
  ];
  private $_clothing = null;

  function __construct(MwseXmlProductDataClothing $clothing)  {
    $this->_clothing = $clothing;
  }

  public function getData() {
    return array_filter($this->_data);
  }

  public function getClothing() {
    return $this->_clothing;
  }

  /**
   * @param Decimal $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBatteryAverageLife($value) {
    $this->_data["BatteryAverageLife"] = $value;
    return $this;
  }

  /**
   * @param Decimal $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBatteryAverageLifeStandby($value) {
    $this->_data["BatteryAverageLifeStandby"] = $value;
    return $this;
  }

  /**
   * @param Decimal $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBatteryChargeTime($value) {
    $this->_data["BatteryChargeTime"] = $value;
    return $this;
  }

  public function setSize($value) {
    $this->_data['Size'] = $value;
    return $this;
  }

  public function setColor($value) {
    $this->_data['Color'] = $value;
    return $this;
  }

  /**
   * @param const $value CLOTHING_TYPE_*
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setClothingType($value) {
    $this->_data["ClothingType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setDepartment($value) {
    $this->_data["Department"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setStyleKeywords($value) {
    $this->_data["StyleKeywords"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setPlatinumKeywords($value) {
    $this->_data["PlatinumKeywords"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setColorMap($value) {
    $this->_data["ColorMap"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */  
  public function setSpecialSizeType($value) {
    $this->_data["SpecialSizeType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */  
  public function setMaterialAndFabric($value) {
    $this->_data["MaterialAndFabric"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */  
  public function setImportDesignation($value) {
    $this->_data["ImportDesignation"] = $value;
    return $this;
  }

  /**
   * @param String $value - 2 chars
   * @return void
   */
  public function setCountryAsLabeled($value) {
    $this->_data["CountryAsLabeled"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setFurDescription($value) {
    $this->_data["FurDescription"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setMaterialComposition($value) {
    $this->_data["MaterialComposition"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setMaterialOpacity($value) {
    $this->_data["MaterialOpacity"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setInnerMaterial($value) {
    $this->_data["InnerMaterial"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setOuterMaterial($value) {
    $this->_data["OuterMaterial"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setSoleMaterial($value) {
    $this->_data["SoleMaterial"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */  
  public function setShoeClosureType($value) {
    $this->_data["ShoeClosureType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setApparelClosureType($value) {
    $this->_data["ApparelClosureType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setClosureType($value) {
    $this->_data["ClosureType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setCareInstructions($value) {
    $this->_data["CareInstructions"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setOccasionAndLifestyle($value) {
    $this->_data["OccasionAndLifestyle"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setEventKeywords($value) {
    $this->_data["EventKeywords"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setSeason($value) {
    $this->_data["Season"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setSpecificUses($value) {
    $this->_data["SpecificUses"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */    
  public function setExternalTestingCertification($value) {
    $this->_data["ExternalTestingCertification"]  =$value;
    return $this;
  }

  /**
   * @param String $value - PERFORMANCE_RATING_*
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setPerformanceRating($value) {
    $this->_data["PerformanceRating"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */      
  public function setProductSpecification($value) {
    $this->_data["ProductSpecification"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */      
  public function setWarnings($value) {
    $this->_data["Warnings"] = $value;
    return $this;
  }

  /**
   * @param Boolean $value
   * @return MwseXmlProductDataClothingClassificationData
   */      
  public function setIsCustomizable($value) {
    $this->_data["IsCustomizable"] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */      
  public function setCustomizableTemplateName($value) {
    $this->_data["CustomizableTemplateName"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */      
  public function setStyleName($value) {
    $this->_data["StyleName"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */      
  public function setCollarType($value) {
    $this->_data["CollarType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */      
  public function setSleeveType($value) {
    $this->_data["SleeveType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */      
  public function setWaistStyle($value) {
    $this->_data["WaistStyle"] = $value;
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setMinimumHeightRecommended(MwseXmlLengthDimension $value) {
    $this->_data["MinimumHeightRecommended"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setMaximumHeightRecommended(MwseXmlLengthDimension $value) {
    $this->_data["MaximumHeightRecommended"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setCountryName($value) {
    $this->_data["CountryName"] = $value;
    return $this;
  }

  /**
   * @param String $value - 2 chars
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setCountryOfOrigin($value) {
    $this->_data["CountryOfOrigin"] = $value;
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setDisplayLength(MwseXmlLengthDimension $value) {
    $this->_data["DisplayLength"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlVolumeDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setDisplayVolume(MwseXmlVolumeDimension $value) {
    $this->_data["DisplayVolume"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlPositiveNonZeroWeightDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setDisplayWeight(MwseXmlPositiveNonZeroWeightDimension $value) {
    $this->_data["DisplayWeight"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setModelName($value) {
    $this->_data["ModelName"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */  
  public function setModelNumber($value) {
    $this->_data["ModelNumber"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */  
  public function setModelYear($value) {
    $this->_data["ModelYear"] = $value;
    return $this;
  }

  /**
   * @param Boolean $value
   * @return MwseXmlProductDataClothingClassificationData
   */  
  public function setIsAdultProduct($value) {
    $this->_data["IsAdultProduct"] = fitler_var($value, FILTER_VALIDATE_BOOLEAN);
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */  
  public function setSizeMap($value) {
    $this->_data["SizeMap"] = $value;
    return $this;
  }

  /**
   * @param MwseXmlProductDataClothingSizeDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setWaistSize(MwseXmlProductDataClothingSizeDimension $value) {
    $this->_data["WaistSize"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlProductDataClothingSizeDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setInseamLength(MwseXmlProductDataClothingSizeDimension $value) {
    $this->_data["InseamLength"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlProductDataClothingSizeDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setSleeveLength(MwseXmlProductDataClothingSizeDimension $value) {
    $this->_data["SleeveLength"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlProductDataClothingSizeDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setNeckSize(MwseXmlProductDataClothingSizeDimension $value) {
    $this->_data["NeckSize"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlProductDataClothingSizeDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setChestSize(MwseXmlProductDataClothingSizeDimension $value) {
    $this->_data["ChestSize"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value - MwseXmlProductDataClothingClassificationData::CUP_SIZE_*
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setCupSize($value) {
    $this->_data["CupSize"] = $value;
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBraBandSize(MwseXmlLengthDimension $value) {
    $this->_data["BraBandSize"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setShoeWidth($value) {
    $this->_data["ShoeWidth"] = $value;
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setHeelHeight(MwseXmlLengthDimension $value) {
    $this->_data["HeelHeight"] = $value->getData();
    return $this;
  }
  
  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setHeelType($value) {
    $this->_data["HeelType"] = $value;
    return $this;
  }

  public function setShaftHeight(MwseXmlLengthDimension $value) {
    $this->_data["ShaftHeight"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setShaftDiameter($value) {
    $this->_data["ShaftDiameter"] = $value;
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBeltLength(MwseXmlLengthDimension $value) {
    $this->_data["BeltLength"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBeltWidth(MwseXmlLengthDimension $value) {
    $this->_data["BeltWidth"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBeltStyle($value) {
    $this->_data["BeltStyle"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBottomStyle($value) {
    $this->_data["BottomStyle"] = $value;
    return $this;
  }

  /**
   * @param Number $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setButtonQuantity($value) {
    $this->_data["ButtonQuantity"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setCharacter($value) {
    $this->_data["Character"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setControlType($value) {
    $this->_data["ControlType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setCuffType($value) {
    $this->_data["CuffType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setFabricType($value) {
    $this->_data["FabricType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setFabricWash($value) {
    $this->_data["FabricWash"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setFitType($value) {
    $this->_data["FitType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setFitToSizeDescription($value) {
    $this->_data["FitToSizeDescription"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setFrontPleatType($value) {
    $this->_data["FrontPleatType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setIncludedComponents($value) {
    $this->_data["IncludedComponents"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setItemRise(MwseXmlLengthDimension $value) {
    $this->_data["ItemRise"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setLaptopCapacity($value) {
    $this->_data["LaptopCapacity"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setLegDiameter($value) {
    $this->_data["LegDiameter"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setLegStyle($value) {
    $this->_data["LegStyle"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setMaterialType($value) {
    $this->_data["MaterialType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setMfrWarrantyDescriptionLabor($value) {
    $this->_data["MfrWarrantyDescriptionLabor"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setMfrWarrantyDescriptionParts($value) {
    $this->_data["MfrWarrantyDescriptionParts"] = $value;
    return $this;
  }
  
  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setMfrWarrantyDescriptionType($value) {
    $this->_data["MfrWarrantyDescriptionType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setNeckStyle($value) {
    $this->_data["NeckStyle"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setOpacity($value) {
    $this->_data["Opacity"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setPatternStyle($value) {
    $this->_data["PatternStyle"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setCollectionName($value) {
    $this->_data["CollectionName"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setFrameMaterialType($value) {
    $this->_data["FrameMaterialType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setLensMaterialType($value) {
    $this->_data["LensMaterialType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setPolarizationType($value) {
    $this->_data["PolarizationType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setLensWidth($value) {
    $this->_data["LensWidth"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setLensHeight($value) {
    $this->_data["LensHeight"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBridgeWidth($value) {
    $this->_data["BridgeWidth"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setPocketDescription($value) {
    $this->_data["PocketDescription"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setRegionOfOrigin($value) {
    $this->_data["RegionOfOrigin"]  =$value;  
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setRiseStyle($value) {
    $this->_data["RiseStyle"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setSafetyWarning($value) {
    $this->_data["SafetyWarning"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setSellerWarrantyDescription($value) {
    $this->_data["SellerWarrantyDescription"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setSpecialFeature(Array $value) {
    $this->_data["SpecialFeature"]  =$value;
    return $this;
  }

  /**
   * @param String $value TARGET_GENDER_*
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setTargetGender($value) {
    $this->_data["TargetGender"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setTheme($value) {
    $this->_data["Theme"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setTopStyle($value) {
    $this->_data["TopStyle"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setUnderwireType($value) {
    $this->_data["UnderwireType"]  =$value;
    return $this;
  }

  /**
   * @param MwseXmlVolumeDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setVolume(MwseXmlVolumeDimension $value) {
    $this->_data["Volume"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value WATER_RESISTANCE_LEVEL_*
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setWaterResistanceLevel($value) {
    $this->_data["WaterResistanceLevel"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setWheelType($value) {
    $this->_data["WheelType"] = $value;
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setFurisodeLength(MwseXmlLengthDimension $value) {
    $this->_data["FurisodeLength"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setFurisodeWidth(MwseXmlLengthDimension $value) {
    $this->_data["FurisodeWidth"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setObiLength(MwseXmlLengthDimension $value) {
    $this->_data["ObiLength"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setObiWidth(MwseXmlLengthDimension $value) {
    $this->_data["ObiWidth"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setTsukeobiWidth(MwseXmlLengthDimension $value) {
    $this->_data["TsukeobiWidth"] = $value->getData();
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setTsukeobiHeight(MwseXmlLengthDimension $value) {
    $this->_data["TsukeobiHeight"]  =$value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setPillowSize($value) {
    $this->_data["PillowSize"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setStrapType($value) {
    $this->_data["StrapType"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setToeShape($value) {
    $this->_data["ToeShape"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setWarrantyType($value) {
    $this->_data["WarrantyType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setWarrantyDescription($value) {
    $this->_data["WarrantyDescription"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setOccasionType($value) {
    $this->_data["OccasionType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setLeatherType($value) {
    $this->_data["LeatherType"]  =$value;
    return $this;
  }

  /**
   * @param Boolean $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setIsVeryHighValue($value) {
    $this->_data["IsVeryHighValue"] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    return $this;
  }

  /**
   * @param Boolean $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setIsStainResistant($value) {
    $this->_data["IsStainResistant"] = fitler_var($value, FILTER_VALIDATE_BOOLEAN);
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setHarmonizedCode($value) {
    $this->_data["HarmonizedCode"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setContributor($value) {
    $this->_data["Contributor"] = $value;
    return $this;
  }

  /**
   * @param MwseXmlLengthDimension $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setBaseLength(MwseXmlLengthDimension $value) {
    $this->_data["BaseLength"] = $value->getData();
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setSupportType($value) {
    $this->_data["SupportType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setWeaveType($value) {
    $this->_data["WeaveType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setEmbroideryType($value) {
    $this->_data["EmbroideryType"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setDesignName($value) {
    $this->_data["DesignName"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setCollectionDescription($value) {
    $this->_data["CollectionDescription"] = $value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setSpecificUsesForProduct($value) {
    $this->_data["SpecificUsesForProduct"] = $value;
    return $this;
  }
  
  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setPatternName($value) {
    $this->_data["PatternName"]  =$value;
    return $this;
  }

  /**
   * @param String $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setShellType($value) {
    $this->_data["ShellType"]  =$value;
    return $this;
  }

  /**
   * @param Number $value
   * @return MwseXmlProductDataClothingClassificationData
   */
  public function setNumberOfWheels($value) {
    $this->_data["NumberOfWheels"] = $value;
    return $this;
  }
}