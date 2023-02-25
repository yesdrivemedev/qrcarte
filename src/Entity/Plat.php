<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $filtre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prixsimple = null;

    #[ORM\Column]
    private ?float $prixdouble = null;

    #[ORM\ManyToOne(inversedBy: 'plats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\Column]
    private ?\DateTime $insertedAt = null;

    #[ORM\Column]
    private ?bool $isDispo = null;

    public function __construct()
    {
        $this->insertedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getFiltre(): ?string
    {
        return $this->filtre;
    }

    public function setFiltre(string $filtre): self
    {
        $this->filtre = $filtre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixsimple(): ?float
    {
        return $this->prixsimple;
    }

    public function setPrixsimple(float $prixsimple): self
    {
        $this->prixsimple = $prixsimple;

        return $this;
    }

    public function getPrixdouble(): ?float
    {
        return $this->prixdouble;
    }

    public function setPrixdouble(float $prixdouble): self
    {
        $this->prixdouble = $prixdouble;

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getInsertedAt(): ?\DateTime
    {
        return $this->insertedAt;
    }

    public function setInsertedAt(\DateTime $insertedAt): self
    {
        $this->insertedAt = $insertedAt;

        return $this;
    }

    public function isIsDispo(): ?bool
    {
        return $this->isDispo;
    }

    public function setIsDispo(bool $isDispo): self
    {
        $this->isDispo = $isDispo;

        return $this;
    }
}
