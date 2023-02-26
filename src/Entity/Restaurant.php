<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $css = null;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $nomcourtright = null;

    #[ORM\Column(length: 255)]
    private ?string $nomcourtleft = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phrase1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phrase2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phrase3 = null;

    #[ORM\ManyToOne(inversedBy: 'restaurants')]
    private ?Proprietaire $proprietaire = null;

    #[ORM\Column]
    private ?\DateTime $insertedAt = null;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Categorie::class)]
    private Collection $categories;

    #[ORM\Column]
    private ?bool $isActif = null;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Commande::class)]
    private Collection $commandes;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Mestables::class)]
    private Collection $mestables;

    #[ORM\ManyToOne(inversedBy: 'restaurants')]
    private ?Offre $offre = null;

    public function __construct()
    {
        $this->insertedAt = new \DateTime();
        $this->categories = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->mestables = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNom();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCss(): ?string
    {
        return $this->css;
    }

    public function setCss(string $css): self
    {
        $this->css = $css;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNomcourtright(): ?string
    {
        return $this->nomcourtright;
    }

    public function setNomcourtright(string $nomcourtright): self
    {
        $this->nomcourtright = $nomcourtright;

        return $this;
    }

    public function getNomcourtleft(): ?string
    {
        return $this->nomcourtleft;
    }

    public function setNomcourtleft(string $nomcourtleft): self
    {
        $this->nomcourtleft = $nomcourtleft;

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

    public function getPhrase1(): ?string
    {
        return $this->phrase1;
    }

    public function setPhrase1(?string $phrase1): self
    {
        $this->phrase1 = $phrase1;

        return $this;
    }

    public function getPhrase2(): ?string
    {
        return $this->phrase2;
    }

    public function setPhrase2(?string $phrase2): self
    {
        $this->phrase2 = $phrase2;

        return $this;
    }

    public function getPhrase3(): ?string
    {
        return $this->phrase3;
    }

    public function setPhrase3(?string $phrase3): self
    {
        $this->phrase3 = $phrase3;

        return $this;
    }

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Proprietaire $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getInsertedAt(): ?\DateTimeImmutable
    {
        return $this->insertedAt;
    }

    public function setInsertedAt(\DateTimeImmutable $insertedAt): self
    {
        $this->insertedAt = $insertedAt;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setRestaurant($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getRestaurant() === $this) {
                $category->setRestaurant(null);
            }
        }

        return $this;
    }

    public function isIsActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setRestaurant($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getRestaurant() === $this) {
                $commande->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mestables>
     */
    public function getMestables(): Collection
    {
        return $this->mestables;
    }

    public function addMestable(Mestables $mestable): self
    {
        if (!$this->mestables->contains($mestable)) {
            $this->mestables->add($mestable);
            $mestable->setRestaurant($this);
        }

        return $this;
    }

    public function removeMestable(Mestables $mestable): self
    {
        if ($this->mestables->removeElement($mestable)) {
            // set the owning side to null (unless already changed)
            if ($mestable->getRestaurant() === $this) {
                $mestable->setRestaurant(null);
            }
        }

        return $this;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }
}
