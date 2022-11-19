<?php

use Julio\Store\Entity\Product;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";
$entityManager = EntityManagerCreator::createEntityManager();

$product = new Product($argv[1], $argv[2], $argv[3]);

$entityManager->persist($product);
$entityManager->flush();