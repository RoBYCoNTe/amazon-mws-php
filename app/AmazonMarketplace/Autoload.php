<?php 

require_once ("Mwse/Config.php");
require_once ("Mwse/Client.php");
require_once ("Mwse/Exception.php");
require_once ("Mwse/Xml/AmazonEnvelope.php");
require_once ("Mwse/Xml/Product.php");
require_once ("Mwse/Xml/Price.php");
require_once ("Mwse/Xml/Inventory.php");
require_once ("Mwse/Xml/Deserializer.php");
require_once ("Mwse/Xml/ProductImage.php");
require_once ("Mwse/Xml/LengthDimension.php");
require_once ("Mwse/Xml/PositiveNonZeroWeightDimension.php");
require_once ("Mwse/Xml/Relationship.php");
require_once ("Mwse/Xml/ProductData/Clothing.php");
require_once ("Mwse/Xml/ProductData/ClothingVariationData.php");
require_once ("Mwse/Xml/ProductData/ClothingClassificationData.php");

require_once ("Logger.php");
require_once ("EchoLogger.php");
require_once ("QueueItem.php");
require_once ("QueueManager.php");
require_once ("JsonQueueManager.php");