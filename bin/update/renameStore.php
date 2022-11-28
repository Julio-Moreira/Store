<?php

use Julio\Store\Entity\Store;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";

$entityManager = EntityManagerCreator::createEntityManager();
/** @var Store */
$store = $entityManager->find(Store::class, $argv[1]);

$store->name = $argv[2] ?? $store->name;
$entityManager->flush();