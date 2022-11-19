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

    #[Column, OneToOne(
        targetEntity: Person::class, 
        inversedBy: "telephone"
    )]
    private Person $person;

    public function __construct(
        #[Column(
            unique: true, 
            type: "string", 
            length: 20
        )]
        public $number
    ) { }

    public function setPerson(Person $person): void {
        $this->person = $person;
    }
}