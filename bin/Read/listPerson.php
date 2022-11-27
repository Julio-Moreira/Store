<?php

use Julio\Store\Entity\Person;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";

$entityManager = EntityManagerCreator::createEntityManager();
/** @var Person */
$person = $entityManager->find(Person::class, $argv[1]);

echo "NAME: {$person->getFullName()}" . PHP_EOL;
echo "TELEPHONE: {$person->telephone}" . PHP_EOL;
echo "PRODUCTS: " . PHP_EOL;
foreach ($person->purchasedProducts()->toArray() as $product) {
    echo "name: {$product->name}";
}