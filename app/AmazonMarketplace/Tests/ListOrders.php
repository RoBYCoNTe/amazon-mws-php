<?php 
$createdAfter = DateTime::createFromFormat('Y-m-d H:i:s', '2019-05-10 00:00:00');
$createdBefore = DateTime::createFromFormat('Y-m-d', '2019-05-10');

$orders = $client->listOrders($createdAfter, $createdBefore, $marketplaceId);

header("Content-Type: text/plain");
print_r($orders);