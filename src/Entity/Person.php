<?php
namespace Julio\Store\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table("people")]
class Person {
    #[Id, GeneratedValue, Column]
    public int $id;
    
    #[Column, ManyToMany(Product::class, "buyers")]
    private Collection $products;
    
    #[OneToOne(
        targetEntity: Phone::class, 
        mappedBy: "person"
    )]
    public string $telephone;

    public function __construct(
        #[Column(
            type: "string", 
            length: 10
        )]
        public string $name,
        
        #[Column(
            name: "last_name", 
            type: "string", 
            length: 30, 
            unique: true
        )]
        private string $lastName
    ) {
        $this->products = new ArrayCollection();
    }

    public function getFullName(): string {
        return "{$this->name} {$this->lastName}";
    }

    public function setPhone(Phone $phone): void {
        $this->telephone = $phone->number;
        $phone->setPerson($this);
    }

    public function purchasedProducts(): Collection {
        return $this->products;
    }

    public function buyProduct(Product $product): void {
        if ($this->products->contains($product)) return;

        $this->products->add($product);
        $product->addBuyer($this);
    }    
}