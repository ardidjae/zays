<?php

namespace App\Entity;

use App\Repository\AppartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartementRepository::class)]
class Appartement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'appartement', targetEntity: Bail::class)]
    private Collection $bails;

    #[ORM\ManyToOne(inversedBy: 'appartements')]
    private ?Immeuble $immeuble = null;

    #[ORM\Column]
    private ?int $porte = null;

    #[ORM\Column]
    private ?float $surfaceHabitable = null;

    #[ORM\Column]
    private ?float $surfaceSol = null;

    #[ORM\Column(length: 255)]
    private ?string $situation = null;

    #[ORM\ManyToMany(targetEntity: Equipement::class, inversedBy: 'appartements')]
    private Collection $equipement;

    public function __construct()
    {
        $this->bails = new ArrayCollection();
        $this->equipement = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Bail>
     */
    public function getBails(): Collection
    {
        return $this->bails;
    }

    public function addBail(Bail $bail): static
    {
        if (!$this->bails->contains($bail)) {
            $this->bails->add($bail);
            $bail->setAppartement($this);
        }

        return $this;
    }

    public function removeBail(Bail $bail): static
    {
        if ($this->bails->removeElement($bail)) {
            // set the owning side to null (unless already changed)
            if ($bail->getAppartement() === $this) {
                $bail->setAppartement(null);
            }
        }

        return $this;
    }

    public function getImmeuble(): ?Immeuble
    {
        return $this->immeuble;
    }

    public function setImmeuble(?Immeuble $immeuble): static
    {
        $this->immeuble = $immeuble;

        return $this;
    }

    public function getPorte(): ?int
    {
        return $this->porte;
    }

    public function setPorte(int $porte): static
    {
        $this->porte = $porte;

        return $this;
    }

    public function getSurfaceHabitable(): ?float
    {
        return $this->surfaceHabitable;
    }

    public function setSurfaceHabitable(float $surfaceHabitable): static
    {
        $this->surfaceHabitable = $surfaceHabitable;

        return $this;
    }

    public function getSurfaceSol(): ?float
    {
        return $this->surfaceSol;
    }

    public function setSurfaceSol(float $surfaceSol): static
    {
        $this->surfaceSol = $surfaceSol;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(string $situation): static
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipement(): Collection
    {
        return $this->equipement;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipement->contains($equipement)) {
            $this->equipement->add($equipement);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        $this->equipement->removeElement($equipement);

        return $this;
    }
}
