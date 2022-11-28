<?php

use Julio\Store\Entity\Person;
use Julio\Store\Entity\Phone;
use Julio\Store\helper\EntityManagerCreator;

require_once __DIR__ . "/../../vendor/autoload.php";

$entityManager = EntityManagerCreator::createEntityManager();
/** @var Person */
$person = $entityManager->find(Person::class, $argv[1]);

$entityManager->remove($person->telephone);
$entityManager->flush();

$person->setPhone(new Phone($argv[2]));
$entityManager->flush();