<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'Proprietaire', targetEntity: Fichier::class, orphanRemoval: true)]
    private Collection $fichiers;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Telecharger::class)]
    private Collection $telechargers;

    #[ORM\ManyToMany(targetEntity: Fichier::class, mappedBy: 'user')]
    private Collection $partager;

    public function __construct()
    {
        $this->fichiers = new ArrayCollection();
        $this->telechargers = new ArrayCollection();
        $this->partager = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Fichier>
     */
    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function addFichier(Fichier $fichier): static
    {
        if (!$this->fichiers->contains($fichier)) {
            $this->fichiers->add($fichier);
            $fichier->setProprietaire($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $fichier): static
    {
        if ($this->fichiers->removeElement($fichier)) {
            // set the owning side to null (unless already changed)
            if ($fichier->getProprietaire() === $this) {
                $fichier->setProprietaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Telecharger>
     */
    public function getTelechargers(): Collection
    {
        return $this->telechargers;
    }

    public function addTelecharger(Telecharger $telecharger): static
    {
        if (!$this->telechargers->contains($telecharger)) {
            $this->telechargers->add($telecharger);
            $telecharger->setUser($this);
        }

        return $this;
    }

    public function removeTelecharger(Telecharger $telecharger): static
    {
        if ($this->telechargers->removeElement($telecharger)) {
            // set the owning side to null (unless already changed)
            if ($telecharger->getUser() === $this) {
                $telecharger->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fichier>
     */
    public function getPartager(): Collection
    {
        return $this->partager;
    }

    public function addPartager(Fichier $partager): static
    {
        if (!$this->partager->contains($partager)) {
            $this->partager->add($partager);
            $partager->addUser($this);
        }

        return $this;
    }

    public function removePartager(Fichier $partager): static
    {
        if ($this->partager->removeElement($partager)) {
            $partager->removeUser($this);
        }

        return $this;
    }
}
