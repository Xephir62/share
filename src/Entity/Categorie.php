<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToMany(targetEntity: Fichier::class, inversedBy: 'categories')]
    private Collection $Fichier;

    public function __construct()
    {
        $this->Fichier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Fichier>
     */
    public function getFichier(): Collection
    {
        return $this->Fichier;
    }

    public function addFichier(Fichier $fichier): static
    {
        if (!$this->Fichier->contains($fichier)) {
            $this->Fichier->add($fichier);
        }

        return $this;
    }

    public function removeFichier(Fichier $fichier): static
    {
        $this->Fichier->removeElement($fichier);

        return $this;
    }
}
