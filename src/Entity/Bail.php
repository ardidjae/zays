<?php

namespace App\Entity;

use App\Repository\BailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BailRepository::class)]
class Bail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column]
    private ?float $MontantHC = null;

    #[ORM\Column]
    private ?float $MontantCharges = null;

    #[ORM\Column]
    private ?float $MontantCaution = null;

    #[ORM\Column(length: 255)]
    private ?string $NomCaution1 = null;

    #[ORM\Column(length: 255)]
    private ?string $NomCaution2 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $DureeBail = null;

    #[ORM\Column(length: 255)]
    private ?string $BailSigne = null;

    #[ORM\Column(length: 255)]
    private ?string $EtatLieuEntree = null;

    #[ORM\Column(length: 255)]
    private ?string $EtatLieuSortie = null;

    #[ORM\Column(length: 255)]
    private ?string $AttestationAssurance = null;

    #[ORM\ManyToOne(inversedBy: 'bails')]
    private ?Appartement $appartement = null;

    #[ORM\OneToMany(mappedBy: 'bail', targetEntity: Paiement::class)]
    private Collection $paiements;

    #[ORM\ManyToOne(inversedBy: 'bails')]
    private ?Associe $associe = null;

    #[ORM\ManyToMany(inversedBy: 'bails', targetEntity: Locataire::class, cascade: ['persist'])]
    private Collection $locataires;

    #[ORM\Column]
    private ?float $MontantPremEcheance = null;

    #[ORM\Column]
    private ?float $MontantDerEcheance = null;

    #[ORM\Column(length: 255)]
    private ?string $TrimestreReference = null;

    #[ORM\Column(length: 255)]
    private ?string $PieceJustificative = null;

    #[ORM\Column]
    private ?int $archive = null;

    #[ORM\Column]
    private ?float $CautionRestituer = null;

    #[ORM\Column(length: 255)]
    private ?string $EtatLieuEntreeSigne = null;

    #[ORM\Column(length: 255)]
    private ?string $EtatLieuSortieSigne = null;

    #[ORM\OneToMany(mappedBy: 'bail', targetEntity: SousCategorie::class)]
    private Collection $sousCategories;

    public function __construct()
    {
        $this->paiements = new ArrayCollection();
        $this->locataires = new ArrayCollection();
        $this->sousCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getMontantHC(): ?float
    {
        return $this->MontantHC;
    }

    public function setMontantHC(float $MontantHC): static
    {
        $this->MontantHC = $MontantHC;

        return $this;
    }

    public function getMontantCharges(): ?float
    {
        return $this->MontantCharges;
    }

    public function setMontantCharges(float $MontantCharges): static
    {
        $this->MontantCharges = $MontantCharges;

        return $this;
    }

    public function getMontantCaution(): ?float
    {
        return $this->MontantCaution;
    }

    public function setMontantCaution(float $MontantCaution): static
    {
        $this->MontantCaution = $MontantCaution;

        return $this;
    }

    public function getNomCaution1(): ?string
    {
        return $this->NomCaution1;
    }

    public function setNomCaution1(string $NomCaution1): static
    {
        $this->NomCaution1 = $NomCaution1;

        return $this;
    }

    public function getNomCaution2(): ?string
    {
        return $this->NomCaution2;
    }

    public function setNomCaution2(string $NomCaution2): static
    {
        $this->NomCaution2 = $NomCaution2;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->DateFin;
    }

    public function setDateFin(\DateTimeInterface $DateFin): static
    {
        $this->DateFin = $DateFin;

        return $this;
    }

    public function getDureeBail(): ?string
    {
        return $this->DureeBail;
    }

    public function setDureeBail(string $DureeBail): static
    {
        $this->DureeBail = $DureeBail;

        return $this;
    }

    public function getBailSigne(): ?string
    {
        return $this->BailSigne;
    }

    public function setBailSigne(string $BailSigne): static
    {
        $this->BailSigne = $BailSigne;

        return $this;
    }

    public function getEtatLieuEntree(): ?string
    {
        return $this->EtatLieuEntree;
    }

    public function setEtatLieuEntree(string $EtatLieuEntree): static
    {
        $this->EtatLieuEntree = $EtatLieuEntree;

        return $this;
    }

    public function getEtatLieuSortie(): ?string
    {
        return $this->EtatLieuSortie;
    }

    public function setEtatLieuSortie(string $EtatLieuSortie): static
    {
        $this->EtatLieuSortie = $EtatLieuSortie;

        return $this;
    }

    public function getAttestationAssurance(): ?string
    {
        return $this->AttestationAssurance;
    }

    public function setAttestationAssurance(string $AttestationAssurance): static
    {
        $this->AttestationAssurance = $AttestationAssurance;

        return $this;
    }

    public function getAppartement(): ?Appartement
    {
        return $this->appartement;
    }

    public function setAppartement(?Appartement $appartement): static
    {
        $this->appartement = $appartement;

        return $this;
    }

    /**
     * @return Collection<int, Paiement>
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): static
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements->add($paiement);
            $paiement->setBail($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): static
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getBail() === $this) {
                $paiement->setBail(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Locataire>
     */
    public function getLocataires(): Collection
    {
        return $this->locataires;
    }

    public function addLocataire(Locataire $locataire): self
    {
        if (!$this->locataires->contains($locataire)) {
            $this->locataires->add($locataire);
            $locataire->addBail($this);
        }

        return $this;
    }

    public function removeLocataire(Locataire $locataire): self
    {
        $this->locataires->removeElement($locataire);

        return $this;
    }

    public function getAssocie(): ?Associe
    {
        return $this->associe;
    }

    public function setAssocie(?Associe $associe): static
    {
        $this->associe = $associe;

        return $this;
    }



    


    public function getMontantPremEcheance(): ?float
    {
        return $this->MontantPremEcheance;
    }

    public function setMontantPremEcheance(float $MontantPremEcheance): static
    {
        $this->MontantPremEcheance = $MontantPremEcheance;

        return $this;
    }

    public function getMontantDerEcheance(): ?float
    {
        return $this->MontantDerEcheance;
    }

    public function setMontantDerEcheance(float $MontantDerEcheance): static
    {
        $this->MontantDerEcheance = $MontantDerEcheance;

        return $this;
    }

    public function getTrimestreReference(): ?string
    {
        return $this->TrimestreReference;
    }

    public function setTrimestreReference(string $TrimestreReference): static
    {
        $this->TrimestreReference = $TrimestreReference;

        return $this;
    }

    public function getPieceJustificative(): ?string
    {
        return $this->PieceJustificative;
    }

    public function setPieceJustificative(string $PieceJustificative): static
    {
        $this->PieceJustificative = $PieceJustificative;

        return $this;
    }

    public function getArchive(): ?int
    {
        return $this->archive;
    }

    public function setArchive(int $archive): static
    {
        $this->archive = $archive;

        return $this;
    }

    public function getCautionRestituer(): ?float
    {
        return $this->CautionRestituer;
    }

    public function setCautionRestituer(float $CautionRestituer): static
    {
        $this->CautionRestituer = $CautionRestituer;

        return $this;
    }

    public function getEtatLieuEntreeSigne(): ?string
    {
        return $this->EtatLieuEntreeSigne;
    }

    public function setEtatLieuEntreeSigne(string $EtatLieuEntreeSigne): static
    {
        $this->EtatLieuEntreeSigne = $EtatLieuEntreeSigne;

        return $this;
    }

    public function getEtatLieuSortieSigne(): ?string
    {
        return $this->EtatLieuSortieSigne;
    }

    public function setEtatLieuSortieSigne(string $EtatLieuSortieSigne): static
    {
        $this->EtatLieuSortieSigne = $EtatLieuSortieSigne;

        return $this;
    }

    /**
     * @return Collection<int, SousCategorie>
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategory(SousCategorie $sousCategory): static
    {
        if (!$this->sousCategories->contains($sousCategory)) {
            $this->sousCategories->add($sousCategory);
            $sousCategory->setBail($this);
        }

        return $this;
    }

    public function removeSousCategory(SousCategorie $sousCategory): static
    {
        if ($this->sousCategories->removeElement($sousCategory)) {
            // set the owning side to null (unless already changed)
            if ($sousCategory->getBail() === $this) {
                $sousCategory->setBail(null);
            }
        }

        return $this;
    }
}
