<?php

use Julio\Store\Entity\Product;
use Julio\Store\Entity\Store;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";

$entityManager = EntityManagerCreator::createEntityManager();
/** @var Product */
$product = $entityManager->find(Product::class, $argv[1]);
$newStore = $entityManager->find(Store::class, $argv[2]);
$oldStore = $product->store;

$oldStore->removeProduct($product);
$product->setStore($newStore);
$entityManager->flush(); 