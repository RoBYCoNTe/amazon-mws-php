<?php 
/**
 * Undocumented function
 *
 * @return MwseXmlAmazonEnvelope
 */
function createProduct($config) {
  $envelope = new MwseXmlAmazonEnvelope();
  $envelope->setMerchantIdentifier("MERCHANTID");
  $envelope->setMessageType("Product");
  
  $product = new MwseXmlProduct();
  $product
    ->setSKU($config['sku'])
    ->setOperationType("Update")
    ->setItemPackageQuantity(1)
    ->setNumberOfItems(1);
    
  $productDescriptionData = $product->getDescriptionData();
  $productDescriptionData
    ->setTitle("My awesome product")
    ->setBrand("My Digital Print")
    ->setItemType("Shirt")
    ->setMaxOrderQuantity(1)
    ->setManufacturer("Roberto")
    ->setRecommendedBrowseNode(["2893334031"]) // /Categorie/Donna/Abbigliamento premaman/Abiti
    ->setPackageDimensions("Length", MwseXmlLengthDimension::create("10", MwseXmlLengthUnitOfMeasure::getCm()))
    ->setPackageDimensions("Width", MwseXmlLengthDimension::create("10", MwseXmlLengthUnitOfMeasure::getCm()))
    ->setPackageDimensions("Height", MwseXmlLengthDimension::create("10", MwseXmlLengthUnitOfMeasure::getCm()))
    ->setBulletPoint([
      "Item 1",
      "Item 2",
      "Item 3"
    ]);
  $clothing = new MwseXmlProductDataClothing();
  $clothing->getClassificationData()
    ->setSize("XL")
    ->setDepartment("Department?")
    ->setMaterialComposition("Cotone")
    ->setOuterMaterial("Sintetico")
    ->setClothingType(MwseXmlProductDataClothingClassificationData::CLOTHING_TYPE_SHIRT)
    ->setNeckSize(MwseXmlProductDataClothingSizeDimension::create("10", MwseXmlProductDataClothingSizeUnitOfMeasure::getCm()))
    ->setCountryName("Italy");
  $clothing->getVariationData()->setParentage("child")->setVariationTheme("Color")->setColor("Yellow");
  
  $product->setProductData($clothing);
  $envelope->addMessage($product);
  return $envelope;
}
