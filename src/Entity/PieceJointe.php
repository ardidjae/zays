<?php

namespace App\Entity;

use App\Repository\PieceJointeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceJointeRepository::class)]
class PieceJointe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFichier = null;

    #[ORM\ManyToOne(inversedBy: 'pieceJointes')]
    private ?Locataire $locataire = null;

    #[ORM\ManyToOne(inversedBy: 'pieceJointes')]
    private ?TypeJointe $typejointe = null;

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

    public function getNomFichier(): ?string
    {
        return $this->nomFichier;
    }

    public function setNomFichier(string $nomFichier): static
    {
        $this->nomFichier = $nomFichier;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): static
    {
        $this->locataire = $locataire;

        return $this;
    }

    public function getTypejointe(): ?TypeJointe
    {
        return $this->typejointe;
    }

    public function setTypejointe(?TypeJointe $typejointe): static
    {
        $this->typejointe = $typejointe;

        return $this;
    }
}
