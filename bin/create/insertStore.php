<?php

use Julio\Store\Entity\Product;
use Julio\Store\Entity\Store;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";
$entityManager = EntityManagerCreator::createEntityManager();

$store = new Store($argv[1], $argv[2], $argv[3]);

for ($i = 4; $i < $argc; $i++) { 
    $productValues = explode(' | ', $argv[$i], 3);

    $store->addProduct(new Product(
        $productValues[0], 
        $productValues[1], 
        $productValues[2]
    ));
}

$entityManager->persist($store);
$entityManager->flush();