<?php 

$productSKU = $_GET['SKU'];
$variationSKU = $_GET['VariationSKU'];
/*
// Step 1 - Create the "principal" product.
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("Product");

$product = new MwseXmlProduct();
$product
  ->setSKU($productSKU)
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
$clothing->getVariationData()->setParentage("parent")->setVariationTheme("ColorSize");
$product->setProductData($clothing);
$envelope->addMessage($product);

$request = ['marketplaceId' => $marketplaceId, 'feed' => $envelope->getXML()];
$response = $client->submitProduct($request);
enqueue_feed_request($request, $response);

// Update product price.
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("Price");
$price = new MwseXmlPrice();
$price->setSKU($productSKU);
$price->setStandardPrice(MwseXmlCurrencyAmount::create("10", MwseXmlCurrencyCode::getEUR()));
$envelope->addMessage($price);

$request = ['marketplaceId' => $marketplaceId, 'feed' => $envelope->getXML()];
$response = $client->submitPrice($request);
enqueue_feed_request($request, $response);

// Update inventory.
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("Inventory");
$inventory = new MwseXmlInventory();
$inventory->setSKU($productSKU);
$inventory->setQuantity(10);
$envelope->addMessage($inventory);

$request = ['marketplaceId' => $marketplaceId, 'feed' => $envelope->getXML()];
$response = $client->submitInventory($request);
enqueue_feed_request($request, $response);

// Add some images.
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("ProductImage");
$productImage = new MwseXmlProductImage();
$productImage->setImageLocation("https://www.tramabianca.it/wp-content/uploads/2019/04/popl200_rb_ficha1-378x500-300x397.jpg");
$productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_MAIN);
$productImage->setSKU($productSKU);
$envelope->addMessage($productImage);

$productImage = new MwseXmlProductImage();
$productImage->setImageLocation("https://cdna.4imprint.com/prod/extras/006729/391089/700/1.jpg");
$productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_PT1);
$productImage->setSKU($productSKU);
$envelope->addMessage($productImage);

$productImage = new MwseXmlProductImage();
$productImage->setImageLocation("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzOiYJ0EikZBENCRvP1zV8Cxd2IJgroRKUaUB7MSq4Jvr_cUCE");
$productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_PT2);
$productImage->setSKU($productSKU); 
$envelope->addMessage($productImage);   

$request = ['marketplaceId' => $marketplaceId, 'feed' => $envelope->getXML()];
$response = $client->submitImages($request);
enqueue_feed_request($request, $response);

// Step 2 - Create variation

$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("Product");

$product = new MwseXmlProduct();
$product
  ->setSKU($variationSKU)
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
$clothing->getVariationData()->setParentage("child")->setColor("Red");
$product->setProductData($clothing);
$envelope->addMessage($product);

$request = ['marketplaceId' => $marketplaceId, 'feed' => $envelope->getXML()];
$response = $client->submitProduct($request);
enqueue_feed_request($request, $response);
*/
// Step 3 - Set relationship
$envelope = new MwseXmlAmazonEnvelope();
$envelope->setMessageType("Relationship");
$relationship = new MwseXmlRelationship();
$relationship->setParentSKU($productSKU);
$relationship->addRelation($variationSKU, "Variation");
$envelope->addMessage($relationship);

$request = ['marketplaceId' => $marketplaceId, 'feed' => $envelope->getXML()];
$response = $client->submitRelationship($request);
enqueue_feed_request($request, $response);

header ("Content-Type: text/plain");
print "Let's refresh in the next tab ;-)";