<?php

use Julio\Store\Entity\Store;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";

$entityManager = EntityManagerCreator::createEntityManager();
/** @var Store */
$store = $entityManager->find(Store::class, $argv[1]);

echo "NAME: {$store->name}" . PHP_EOL;
echo "OWNER: {$store->owner}" . PHP_EOL;
foreach ($store->getProducts()->toArray() as $product) {
    echo "name: {$product->name}" . PHP_EOL;
}