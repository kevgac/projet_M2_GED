<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'integer')]
    private ?int $unitPrice = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate;

    #[ORM\ManyToMany(targetEntity: Customers::class, mappedBy: 'products')]
    private Collection $customers;

    #[ORM\OneToOne(mappedBy: 'products', targetEntity: Fds::class, cascade: ['persist', 'remove'])]
    private ?Fds $fds = null;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->creationDate = new \DateTime();
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

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): static
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getFds(): ?Fds
    {
        return $this->fds;
    }

    /**
     * @return Collection|Customers[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customers $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers->add($customer);
            $customer->addProduct($this);
        }

        return $this;
    }

    public function removeCustomer(Customers $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeProduct($this);
        }

        return $this;
    }


    public function __toString(): string
    {
        return $this->name;
    }
}
