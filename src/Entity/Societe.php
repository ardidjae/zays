<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $numRue = null;

    #[ORM\Column(length: 255)]
    private ?string $rue = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $numTel = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column]
    private ?int $copos = null;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: Immeuble::class)]
    private Collection $immeubles;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: Associe::class)]
    private Collection $associes;

    public function __construct()
    {
        $this->immeubles = new ArrayCollection();
        $this->associes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNumRue(): ?int
    {
        return $this->numRue;
    }

    public function setNumRue(int $numRue): static
    {
        $this->numRue = $numRue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    public function setNumTel(int $numTel): static
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getCopos(): ?int
    {
        return $this->copos;
    }

    public function setCopos(int $copos): static
    {
        $this->copos = $copos;

        return $this;
    }

    /**
     * @return Collection<int, Immeuble>
     */
    public function getImmeubles(): Collection
    {
        return $this->immeubles;
    }

    public function addImmeuble(Immeuble $immeuble): static
    {
        if (!$this->immeubles->contains($immeuble)) {
            $this->immeubles->add($immeuble);
            $immeuble->setSociete($this);
        }

        return $this;
    }

    public function removeImmeuble(Immeuble $immeuble): static
    {
        if ($this->immeubles->removeElement($immeuble)) {
            // set the owning side to null (unless already changed)
            if ($immeuble->getSociete() === $this) {
                $immeuble->setSociete(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Associe>
     */
    public function getAssocies(): Collection
    {
        return $this->associes;
    }

    public function addAssocy(Associe $assocy): static
    {
        if (!$this->associes->contains($assocy)) {
            $this->associes->add($assocy);
            $assocy->setSociete($this);
        }

        return $this;
    }

    public function removeAssocy(Associe $assocy): static
    {
        if ($this->associes->removeElement($assocy)) {
            // set the owning side to null (unless already changed)
            if ($assocy->getSociete() === $this) {
                $assocy->setSociete(null);
            }
        }

        return $this;
    }
}
