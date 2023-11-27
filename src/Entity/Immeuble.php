<?php

namespace App\Entity;

use App\Repository\ImmeubleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImmeubleRepository::class)]
class Immeuble
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column]
    private ?int $NumRue = null;

    #[ORM\Column(length: 255)]
    private ?string $Rue = null;

    #[ORM\Column]
    private ?int $Copos = null;

    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\OneToMany(mappedBy: 'immeuble', targetEntity: Appartement::class)]
    private Collection $appartements;

    public function __construct()
    {
        $this->appartements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getNumRue(): ?int
    {
        return $this->NumRue;
    }

    public function setNumRue(int $NumRue): static
    {
        $this->NumRue = $NumRue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->Rue;
    }

    public function setRue(string $Rue): static
    {
        $this->Rue = $Rue;

        return $this;
    }

    public function getCopos(): ?int
    {
        return $this->Copos;
    }

    public function setCopos(int $Copos): static
    {
        $this->Copos = $Copos;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;

        return $this;
    }

    /**
     * @return Collection<int, Appartement>
     */
    public function getAppartements(): Collection
    {
        return $this->appartements;
    }

    public function addAppartement(Appartement $appartement): static
    {
        if (!$this->appartements->contains($appartement)) {
            $this->appartements->add($appartement);
            $appartement->setImmeuble($this);
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): static
    {
        if ($this->appartements->removeElement($appartement)) {
            // set the owning side to null (unless already changed)
            if ($appartement->getImmeuble() === $this) {
                $appartement->setImmeuble(null);
            }
        }

        return $this;
    }
}
