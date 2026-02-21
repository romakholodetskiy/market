<?php

namespace App\Entity;

use App\Enum\ProductStatus;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::INTEGER, enumType: ProductStatus::class)]
    private ProductStatus $status;

    /**
     * @var Collection<int, WarehouseStock>
     */
    #[ORM\OneToMany(targetEntity: WarehouseStock::class, mappedBy: 'product', orphanRemoval: true)]
    private Collection $warehouseStocks;


    public function __construct()
    {
        $this->warehouseStocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ProductStatus
    {
        return $this->status;
    }

    public function setStatus(ProductStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, WarehouseStock>
     */
    public function getWarehouseStocks(): Collection
    {
        return $this->warehouseStocks;
    }

    public function addWarehouseStock(WarehouseStock $warehouseStock): static
    {
        if (!$this->warehouseStocks->contains($warehouseStock)) {
            $this->warehouseStocks->add($warehouseStock);
            $warehouseStock->setProduct($this);
        }

        return $this;
    }

    public function removeWarehouseStock(WarehouseStock $warehouseStock): static
    {
        if ($this->warehouseStocks->removeElement($warehouseStock)) {
            // set the owning side to null (unless already changed)
            if ($warehouseStock->getProduct() === $this) {
                $warehouseStock->setProduct(null);
            }
        }

        return $this;
    }
}
