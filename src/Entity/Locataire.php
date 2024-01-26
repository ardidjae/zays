<?php

namespace App\Entity;

use App\Repository\LocataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LocataireRepository::class)]
class Locataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le nom est requis.")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom doit comporter au maximum 50 caractères",
    )]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le prénom est requis.")]
    #[Assert\Length(
        min: 2,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères."
    )]
    private ?string $Prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date de naissance est requise.")]
    #[Assert\LessThan('today', message:'La date ne peut pas être supérieure à aujourd\'hui')]
    private ?\DateTimeInterface $DateNaissance = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le lieu de naissance est requis.")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le lieu de naissance doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le lieu de naissance doit comporter au maximum 50 caractères",
    )]
    private ?string $LieuNaissance = null;

    #[ORM\Column]
    private ?float $MontantCaf = null;

    #[ORM\Column]
    private ?float $Archive = null;



    #[ORM\OneToMany(mappedBy: 'locataire', targetEntity: PieceJointe::class)]
    private Collection $pieceJointes;

    #[ORM\ManyToMany(targetEntity: Bail::class, mappedBy: 'locataire')]
    private Collection $bails;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'adresse e-mail est requise.")]
    #[Assert\Email(message: "L'adresse e-mail n'est pas valide.")]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le numéro de téléphone est requis.")]
    #[Assert\Type(type: "numeric", message: "Le numéro de téléphone doit être numérique.")]
    private ?float $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $pieceJustificative = null;

    public function __construct()
    {
        $this->bails = new ArrayCollection();
        $this->pieceJointes = new ArrayCollection();
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

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $DateNaissance): static
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->LieuNaissance;
    }

    public function setLieuNaissance(string $LieuNaissance): static
    {
        $this->LieuNaissance = $LieuNaissance;

        return $this;
    }

    public function getMontantCaf(): ?float
    {
        return $this->MontantCaf;
    }

    public function setMontantCaf(float $MontantCaf): static
    {
        $this->MontantCaf = $MontantCaf;

        return $this;
    }

    public function getArchive(): ?float
    {
        return $this->Archive;
    }

    public function setArchive(float $Archive): static
    {
        $this->Archive = $Archive;

        return $this;
    }

    /**
     * @return Collection<int, Bail>
     */
    public function getBails(): Collection
    {
        return $this->bails;
    }

    public function addBail(Bail $bail): self
    {
        if (!$this->bails->contains($bail)) {
            $this->bails->add($bail);
            $bail->addLocataire($this);
        }

        return $this;
    }

    public function removeBail(Bail $bail): self
    {
        if ($this->bails->removeElement($bail)) {
            $bail->removeLocataire($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PieceJointe>
     */
    public function getPieceJointes(): Collection
    {
        return $this->pieceJointes;
    }

    public function addPieceJointe(PieceJointe $pieceJointe): static
    {
        if (!$this->pieceJointes->contains($pieceJointe)) {
            $this->pieceJointes->add($pieceJointe);
            $pieceJointe->setLocataire($this);
        }

        return $this;
    }

    public function removePieceJointe(PieceJointe $pieceJointe): static
    {
        if ($this->pieceJointes->removeElement($pieceJointe)) {
            // set the owning side to null (unless already changed)
            if ($pieceJointe->getLocataire() === $this) {
                $pieceJointe->setLocataire(null);
            }
        }

        return $this;
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

    public function getTelephone(): ?float
    {
        return $this->telephone;
    }

    public function setTelephone(float $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPieceJustificative(): ?string
    {
        return $this->pieceJustificative;
    }

    public function setPieceJustificative(string $pieceJustificative): static
    {
        $this->pieceJustificative = $pieceJustificative;

        return $this;
    }
}
