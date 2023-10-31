<?php

namespace App\Entity;

use App\Repository\TelechargerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelechargerRepository::class)]
class Telecharger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb = null;

    #[ORM\ManyToOne(inversedBy: 'telechargers')]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'telechargers')]
    private ?Fichier $Fichier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNb(): ?int
    {
        return $this->nb;
    }

    public function setNb(?int $nb): static
    {
        $this->nb = $nb;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getFichier(): ?Fichier
    {
        return $this->Fichier;
    }

    public function setFichier(?Fichier $Fichier): static
    {
        $this->Fichier = $Fichier;

        return $this;
    }
}
