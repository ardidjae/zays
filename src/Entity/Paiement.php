<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateP = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(length: 255)]
    private ?string $Source = null;

    #[ORM\ManyToOne(inversedBy: 'paiements')]
    private ?Bail $bail = null;

    #[ORM\ManyToOne(inversedBy: 'paiements')]
    private ?MoisAnnee $moisannee = null;

    #[ORM\Column]
    private ?float $caf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateP(): ?\DateTimeInterface
    {
        return $this->dateP;
    }

    public function setDateP(\DateTimeInterface $dateP): static
    {
        $this->dateP = $dateP;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->Source;
    }

    public function setSource(string $Source): static
    {
        $this->Source = $Source;

        return $this;
    }

    public function getBail(): ?Bail
    {
        return $this->bail;
    }

    public function setBail(?Bail $bail): static
    {
        $this->bail = $bail;

        return $this;
    }

    public function getMoisannee(): ?MoisAnnee
    {
        return $this->moisannee;
    }

    public function setMoisannee(?MoisAnnee $moisannee): static
    {
        $this->moisannee = $moisannee;

        return $this;
    }

    public function getCaf(): ?float
    {
        return $this->caf;
    }

    public function setCaf(float $caf): static
    {
        $this->caf = $caf;

        return $this;
    }
}
