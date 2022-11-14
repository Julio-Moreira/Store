<?php
namespace Julio\Store\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;

#[Entity]
class Phone {
    #[Id, GeneratedValue, Column]
    public int $id;

    #[Column(
        unique: true, 
        type: "string", 
        length: 20
    )]
    public string $number;

    #[Column, OneToOne(
        targetEntity: Person::class, 
        inversedBy: "telephone"
    )]
    private Person $person;

    public function __construct(Person $person) {
        $this->person = $person;
    }

    public function setPerson(Person $person): void {
        $this->person = $person;
    }
}