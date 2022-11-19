<?php

use Julio\Store\Entity\Person;
use Julio\Store\Entity\Phone;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";
$entityManager = EntityManagerCreator::createEntityManager();

$person = new Person($argv[1], $argv[2]);
$phone = new Phone($argv[3]);
$person->setPhone($phone);

$entityManager->persist($person);
$entityManager->flush();