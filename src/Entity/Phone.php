<?php
namespace Julio\Store\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: "telephones")]
class Phone {
    #[Id, GeneratedValue, Column]
    public int $id;

    #[OneToOne(
        targetEntity: Person::class, 
        inversedBy: "telephone"
    )]
    private ?Person $person = null;

    public function __construct(
        #[Column(
            unique: true, 
            type: "string", 
            length: 20
        )]
        public $number
    ) { }

    public function setPerson(Person $person): void {
        if ($this->person == $person) return;

        $this->person = $person;
        $person->setPhone($this);
    }
}