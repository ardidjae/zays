<?php

namespace App\Entity;

use App\Repository\AssocieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssocieRepository::class)]
class Associe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Prenom = null;

    #[ORM\Column]
    private ?int $NumRue = null;

    #[ORM\Column(length: 255)]
    private ?string $Rue = null;

    #[ORM\Column]
    private ?int $Copos = null;

    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\Column]
    private ?int $Tel = null;

    #[ORM\Column(length: 255)]
    private ?string $Mail = null;

    #[ORM\Column(length: 50)]
    private ?string $NbPart = null;

    #[ORM\OneToMany(mappedBy: 'associe', targetEntity: Bail::class)]
    private Collection $bails;

    public function __construct()
    {
        $this->bails = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

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

    public function getTel(): ?int
    {
        return $this->Tel;
    }

    public function setTel(int $Tel): static
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): static
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getNbPart(): ?string
    {
        return $this->NbPart;
    }

    public function setNbPart(string $NbPart): static
    {
        $this->NbPart = $NbPart;

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
            $bail->setAssocie($this);
        }

        return $this;
    }

    public function removeBail(Bail $bail): static
    {
        if ($this->bails->removeElement($bail)) {
            // set the owning side to null (unless already changed)
            if ($bail->getAssocie() === $this) {
                $bail->setAssocie(null);
            }
        }

        return $this;
    }
}
