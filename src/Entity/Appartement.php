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

    #[ORM\Column]
    private ?float $Surface = null;

    #[ORM\OneToMany(mappedBy: 'appartement', targetEntity: Bail::class)]
    private Collection $bails;

    #[ORM\ManyToOne(inversedBy: 'appartements')]
    private ?Immeuble $immeuble = null;

    public function __construct()
    {
        $this->bails = new ArrayCollection();
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

    public function getSurface(): ?float
    {
        return $this->Surface;
    }

    public function setSurface(float $Surface): static
    {
        $this->Surface = $Surface;

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
}
