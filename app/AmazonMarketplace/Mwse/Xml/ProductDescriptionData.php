<?php 

require_once ("Product.php");
require_once ("LengthDimension.php");
require_once ("CurrencyAmount.php");

/**
 * Contains information used to create the product on Amazon, broken into the following components.
 * @author Roberto Conte Rosito <roberto.conterosito@gmail.com>
 */
class MwseXmlProductDescriptionData {
  const PURCHASING_CHANNEL_IN_STORE = "in_store";
  const PURCHASING_CHANNEL_ONLINE = "online";

  const OPTIONAL_PAYMENT_TYPE_EXCLUSION_CASH_ON_DELIVERY = "cash_on_delivery";
  const OPTIONAL_PAYMENT_TYPE_EXCLUSION_CVS = "cvs";
  const OPTIONAL_PAYMENT_TYPE_EXCLUSION_EXCLUDE_NONE = "exclude_none";
  const OPTIONAL_PAYMENT_TYPE_EXCLUSION_EXCLUDE_COD = "exclude cod";
  const OPTIONAL_PAYMENT_TYPE_EXCLUSION_EXCLUDE_CVS = "exclude cvs";
  const OPTIONAL_PAYMENT_TYPE_EXCLUSION_EXCLUDE_COD_AND_CVS = "exclude cod and cvs";

  private $_data = [
    'Title' => null,
    'Brand' => null,
    'Designer' => null,
    'Description' => null,
    'BulletPoint' => null,
    'ItemDimensions' => null,
    'PackageDimensions' => null,
    'PackageWeight' => null,
    'ShippingWeight' => null,
    'MerchantCatalogNumber' => null,
    'MSRP' => null,
    'MSRPWithTax' => null,
    'MaxOrderQuantity' => null,
    'SerialNumberRequired' => null,
    'Prop65' => null,
    'CPSIAWarning' => null,
    'CPSIAWarningDescription' => null,
    'LegalDisclaimer' => null,
    'Manufacturer' => null,
    'MfrPartNumber' => null,
    'SearchTerms' => null,
    'PlatinumKeywords' => null,
    'Memorabilia' => null,
    'Autographed' => null,
    'UsedFor' => null,
    'ItemType' => null,
    'OtherItemAttributes' => null,
    'TargetAudience' => [],
    'SubjectContent' => [],
    'IsGiftWrapAvailable' => null,
    'IsGiftMessageAvailable' => null,
    'PromotionKeywords' => null,
    'IsDiscontinuedByManufacturer' => null,
    'DeliveryScheduleGroupID' => null,
    'DeliveryChannel' => null,
    'PurchasingChannel' => null,
    'MaxAggregateShipQuantity' => null,
    'IsCustomizable' => null,
    'CustomizableTemplateName' => null,
    'RecommendedBrowseNode' => null,
    'MerchantShippingGroupName' => null,
    'FEDAS_ID' => null,
    'TSDAgeWarning' => null,
    'TSDWarning' => null,
    'TSDLanguage' => null,
    'OptionalPaymentTypeExclusion' => null,
    'DistributionDesignation' => null
  ];
  private $_product;

  function __construct(MwseXmlProduct $product) {
    $this->_product = $product;
  }
  
  /**
   * Short description of the product.
   *
   * @param String $title
   * @return MwseXmlProductDescriptionData
   */
   public function setTitle($title) {
    $this->_data['Title'] = $title;
    return $this;
  }
  
  /**
   * Brand of the product.
   *
   * @param String $brand
   * @return MwseXmlProductDescriptionData
   */
  public function setBrand($brand) {
    $this->_data['Brand'] = $brand;
    return $this;
  }

  /**
   * Designer of the product
   *
   * @param String $designer
   * @return MwseXmlProductDescriptionData
   */
  public function setDesigner($designer) {
    $this->_data['Designed'] = $designer;
    return $this;
  }

  /**
   * Long description of the product.
   *
   * @param String $description
   * @return MwseXmlProductDescriptionData
   */
  public function setDescription($description) {
    $this->_data['Description'] = $description;
    return $this;
  }

  /**
   * Brief descriptions of the product's features.
   *
   * @param Array $bulletPoints Max 5 strings.
   * @return MwseXmlProductDescriptionData
   */
  public function setBulletPoint($bulletPoints = []) {
    $this->_data['BulletPoint'] = $bulletPoints;
    return $this;
  }

  /**
   * Calculated dimensions of the product.
   *
   * @param String $name One of "Length", "Width", "Height" and "Weight"
   * @param Array $itemDimensions 
   * @return MwseXmlProductDescriptionData
   */
  public function setItemDimensions($name, MwseXmlLengthDimension $dimension) {
    $this->_data['ItemDimensions'][$name] = $dimension->getData();
    return $this;
  }

  /**
   * Calculated dimensions of the package.
   *
   * @param String $name - Length, Width, Height
   * @param MwseXmlLengthDimension $dimension
   * @return MwseXmlProductDescriptionData
   */
  public function setPackageDimensions($name, MwseXmlLengthDimension $dimension) {
    $this->_data['PackageDimensions'][$name] = $dimension->getData();
    return $this;
  }

  /**
   * Weight of the package.
   *
   * @param MwseXmlPositiveNonZeroWeightDimension $dimension
   * @return MwseXmlProductDescriptionData
   */
  public function setPackageWeight(MwseXmlPositiveNonZeroWeightDimension $dimension) {
    $this->_data['PackageWeight'] = $dimension->getData();
    return $this;
  }

  /**
   * Weight of the product when packaged to ship.
   *
   * @param MwseXmlPositiveNonZeroWeightDimension $dimension
   * @return MwseXmlProductDescriptionData
   */
  public function setShippingWeight(MwseXmlPositiveNonZeroWeightDimension $dimension) {
    $this->_data['ShippingWeight'] = $dimension->getData();
    return $this;
  }

  /**
   * Seller's catalog number for the product, if different from the SKU.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setMerchantCatalogNumber($value) {
    $this->_data['MerchantCatalogNumber'] = $value;
    return $this;
  }

  /**
   * Manufacturer's suggested retail price for the product.
   *
   * @param Currency $value
   * @return MwseXmlProductDescriptionData
   */
  public function setMSRP(MwseXmlCurrencyAmount $amount) {
    $this->_data["MSRP"] = $amount->getData();
    return $this;
  }

  /**
   * Maximum quantity of the product that a customer can order.
   *
   * @param Number $value
   * @return MwseXmlProductDescriptionData
   */
  public function setMaxOrderQuantity($value) {
    $this->_data["MaxOrderQuantity"] = $value;
    return $this;
  }

  /**
   * Indicates whether the product must have a serial number.
   *
   * @param Boolean $value
   * @return MwseXmlProductDescriptionData
   */
  public function setSerialNumberRequired($value) {
    $this->_data["SerialNumberRequired"] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    return $this;
  }

  /**
   * Any legal disclaimer needed with the product.
   *
   * @param String $value (Max 1000 chars)
   * @return MwseXmlProductDescriptionData
   */
  public function setLegalDisclaimer($value) {
    $this->_data["LegalDisclaimer"] = $value;
    return $this;
  }

  /**
   * Maker of the product.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setManufacturer($value) {
    $this->_data["Manufacturer"] = $value;
    return $this;
  }

  /**
   * Part number provided by the original manufacturer.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setMfrPartNumber($value) {
    $this->_data["MfrPartNumber"] = $value;
    return $this;
  }

  /**
   * Terms you submit that give product search results when customers search using the terms.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setSearchTerms($value) {
    $this->_data["SearchTerms"] = $value;
    return $this;
  }

  /**
   * Values used to map products to nodes in a custom browse structure.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setPlatinumKeywords($value) {
    $this->_data["PlatinumKeywords"] = $value;
    return $this;
  }

  /**
   * Value used to classify an item (for example, Shoes > Men’s Shoes > Soccer Shoes).
   * Mandatory for Canada, Europe, and Japan; not used in the US. 
   * Refer to the Seller Central Help pages for more information about Amazon's Browse Tree Guide (BTG) documents.
   *
   * @param Array $value - Max length 2
   * @return MwseXmlProductDescriptionData
   */
  public function setRecommendedBrowseNode($value) {
    $this->_data["RecommendedBrowseNode"] = array_map(function($v) {
      return ['_value' => "$v"];
    }, $value);
    return $this;
  }
  public function addRecommendedBrowseNode($value) {
    if (count($this->_data["RecommendedBrowseNode"]) < 2) {
      $this->_data["RecommendedBrowseNode"][] = ['_value' => "$value"];
      return $this;
    }
    else {
      throw new MwseException("You can specify atleast 2 recommanded browse node.");
    }
  }

  /**
   * Used if the product is a memorabilia item.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setMemorabilia($value) {
    $this->_data["Memorabilia"] = $value;
    return $this;
  }

  /**
   * Used if the product is an autographed item.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setAutographed($value) {
    $this->_data["Autographed"] = $value;
    return $this;
  }

  /**
   * Pre-defined value that specifies where the product should appear within the Amazon browse structure.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setItemType($value) {
    $this->_data["ItemType"] = $value;
    return $this;
  }

  /**
   * Used to further classify the product within the Amazon browse structure.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setOtherItemAttributes($value) {
    $this->_data["OtherItemAttributes"] = $value;
    return $this;
  }

  /**
   * Used to further classify the product within the Amazon browse structure.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setTargetAudience($value) {
    $this->_data["TargetAudience"] = $value;
    return $this;
  }

  /**
   * Used to relate the product to a specific idea or concept for merchandising.
   *
   * @param String $value
   * @return MwseXmlProductDescriptionData
   */
  public function setSubjectContent($value) {
    $this->_data["SubjectContent"] = $value;
    return $this;
  }

  
  /**
   * Indicates whether gift wrapping is available for the product.
   *
   * @param Boolean $value
   * @return MwseXmlProductDescriptionData
   */
   public function setIsGiftWrapAvailable($value) {
    $this->_data["IsGiftWrapAvailable"] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    return $this;
  }

  /**
   * Indicates whether gift messaging is available for the product.
   *
   * @param Boolean $value
   * @return MwseXmlProductDescriptionData
   */
  public function setIsGiftMessageAvailable($value) {
    $this->_data["IsGiftMessageAvailable"] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    return $this;
  }

  /**
   * Indicates that the manufacturer has stopped making the item.
   *
   * @param Boolean $value
   * @return MwseXmlProductDescriptionData
   */
  public function setIsDiscontinuedByManufacturer($value) {
    $this->_data["IsDiscontinuedByManufacturer"] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    return $this;
  }

  /**
   * The maximum number of the same item that can be shipped in the same package.
   *
   * @param Number $value
   * @return MwseXmlProductDescriptionData
   */
  public function setMaxAggregateShipQuantity($value) {
    $this->_data["MaxAggregateShipQuantity"] = $value;
    return $this;
  }


  public function getProduct() {
    return $this->_product;
  }

  public function getData() {
    $this->validate();
    return array_filter($this->_data);
  }

  public function hasData() {
    return !empty($this->_data);
  }

  private function validate() {
    /*
    if (is_null($this->_data['Title']) || empty($this->_data['Title'])) {
      throw new Exception("Product/DescriptionData: Title cannot be empty!");
    }*/
  }
}