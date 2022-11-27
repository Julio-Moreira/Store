<?php

use Julio\Store\Entity\Store;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";

$entityManager = EntityManagerCreator::createEntityManager();
$store = $entityManager->find(Store::class, $argv[1]);

$entityManager->remove($store);
$entityManager->flush();