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

    #[ManyToMany(Person::class, inversedBy: "products", cascade: ["persist"])]
    private Collection $buyers;

    #[ManyToOne(targetEntity: Store::class, inversedBy: "products")]
    public ?Store $store = null;

    public function __construct(
        #[Column(type: "string", length: 15, nullable: true)]
        public string $name,
        #[Column(type: "string", length: 50, nullable: true)]
        public string $description = '',
        #[Column(type: "string", length: 15, nullable: true)]
        public readonly string $manufacturer = ''
    ) {
        $this->buyers = new ArrayCollection();

    }

    public function setStore(Store $store): void {
        if ($this->store == $store) return;

        $this->store = $store;
        $store->addProduct($this);
    }

    public function getInfo(): string {
        return "Product {$this->name} ©{$this->manufacturer} \n Description: {$this->description}";
    }

    public function buyers(): Collection {
        return $this->buyers;
    }

    public function addBuyer(Person $person): void {
        if ($this->buyers()->contains($person)) return;

        $this->buyers->add($person);
        $person->buyProduct($this);
    }
}