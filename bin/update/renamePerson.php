<?php

use Julio\Store\Entity\Person;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";

$entityManager = EntityManagerCreator::createEntityManager();
/** @var Person */
$person = $entityManager->find(Person::class, $argv[1]);

$person->name = $argv[2] ?? $person->name;
$entityManager->flush();