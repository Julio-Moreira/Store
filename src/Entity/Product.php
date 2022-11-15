<?php
namespace Julio\Store\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table("products")]
class Product {
    #[Id, GeneratedValue, Column]
    public int $id;

    #[Column, ManyToMany(Person::class, inversedBy: "products")]
    private Collection $buyers;

    public function __construct(
        #[Column(type: "string", length: 15)]
        public string $name,
        #[Column, ManyToOne(targetEntity: Store::class, inversedBy: "products")]
        public Store $store,
        #[Column(type: "string", length: 50)]
        public string $description = '',
        #[Column(type: "string", length: 15)]
        public readonly string $manufacturer = ''
    ) {
        $this->buyers = new ArrayCollection();
    }

    public function changeStore(Store $store): void {
        $this->store = $store;
    }

    public function getInfo(): string {
        return "Product {$this->name} ©{$this->manufacturer} \n Description: {$this->description}";
    }

    public function buyers(): Collection {
        return $this->buyers();
    }

    public function addBuyer(Person $person): void {
        if ($this->buyers()->contains($person)) return;

        $this->buyers->add($person);
        $person->buyProduct($this);
    }
}