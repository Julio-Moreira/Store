<?php
namespace Julio\Store\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table("shops")]
class Store {
    #[Id, GeneratedValue, Column]
    public int $id;

    #[OneToMany(targetEntity: Product::class, mappedBy: "store", cascade: ["persist", "remove"])]
    private Collection $products;

    public function __construct(
        #[Column(type: "string", length: 15)]
        public string $name,
        #[Column(type: "string", length: 20)]
        public string $address,
        #[Column(type: "string", length: 15)]
        public string $owner
    ) {
        $this->products = new ArrayCollection();
    }

    public function getClients(): array {
        $clients = []; 
        /** @var Product $product */
        foreach ($this->products as $product) {
            $clients[] = $product->buyers()->toArray();
        }

        return $clients;
    }

    public function getProducts(): Collection {
        return $this->products;
    }

    public function addProduct(Product $product): void {
        if ($this->products->contains($product)) return;

        $this->products->add($product);
        $product->setStore($this);
    }
}