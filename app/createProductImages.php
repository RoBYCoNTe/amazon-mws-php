<?php

/**
 * Undocumented function
 *
 * @param array $config
 * @return MwseXmlAmazonEnvelope
 */
function createProductImages($config = []) {
  $envelope = new MwseXmlAmazonEnvelope();
  $envelope->setMessageType("ProductImage");
  $productImage = new MwseXmlProductImage();
  $productImage->setImageLocation("https://www.tramabianca.it/wp-content/uploads/2019/04/popl200_rb_ficha1-378x500-300x397.jpg");
  $productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_MAIN);
  $productImage->setSKU($config['sku']);
  $envelope->addMessage($productImage);
  
  $productImage = new MwseXmlProductImage();
  $productImage->setImageLocation("https://cdna.4imprint.com/prod/extras/006729/391089/700/1.jpg");
  $productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_PT1);
  $productImage->setSKU($config['sku']);
  $envelope->addMessage($productImage);
  
  $productImage = new MwseXmlProductImage();
  $productImage->setImageLocation("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzOiYJ0EikZBENCRvP1zV8Cxd2IJgroRKUaUB7MSq4Jvr_cUCE");
  $productImage->setImageType(MwseXmlProductImage::IMAGE_TYPE_PT2);
  $productImage->setSKU($config['sku']); 
  $envelope->addMessage($productImage);     
  return $envelope;
}