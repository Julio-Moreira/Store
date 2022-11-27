<?php

use Julio\Store\Entity\Person;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";

$entityManager = EntityManagerCreator::createEntityManager();
$person = $entityManager->find(Person::class, $argv[1]);

$entityManager->remove($person);
$entityManager->flush();