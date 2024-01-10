<?php

namespace App\Entity;

use App\Repository\FdsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FdsRepository::class)]
class Fds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $version = null;

    #[ORM\Column(length: 255)]
    private ?string $pdf_Link = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastUpdated = null;

    #[ORM\OneToOne(inversedBy: 'fds', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $productId = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getPdfLink(): ?string
    {
        return $this->pdf_Link;
    }

    public function setPdfLink(string $pdf_Link): static
    {
        $this->pdf_Link = $pdf_Link;

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

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(\DateTimeInterface $lastUpdated): static
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    public function getProductId(): ?Products
    {
        return $this->productId;
    }

    public function setProductId(Products $productId): static
    {
        $this->productId = $productId;

        return $this;
    }
}
