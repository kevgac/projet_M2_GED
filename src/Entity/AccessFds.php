<?php

namespace App\Entity;

use App\Repository\AccessFdsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessFdsRepository::class)]
class AccessFds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastLoginDate = null;

    #[ORM\ManyToOne]
    private ?Customers $customer = null;

    #[ORM\ManyToOne]
    private ?Fds $fds = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastLoginDate(): ?\DateTimeInterface
    {
        return $this->lastLoginDate;
    }

    public function setLastLoginDate(?\DateTimeInterface $lastLoginDate): static
    {
        $this->lastLoginDate = $lastLoginDate;

        return $this;
    }

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getFds(): ?Fds
    {
        return $this->fds;
    }

    public function setFds(?Fds $fds): static
    {
        $this->fds = $fds;

        return $this;
    }
}
