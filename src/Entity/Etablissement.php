<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\String_;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_etab = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_etab = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $e_mail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_proprio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_directeur = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $code_type_affiliation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_affiliation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NIF = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Fokontany $fokoetab = null;

    #[ORM\OneToMany(mappedBy: 'etabenseignant', targetEntity: Enseignant::class)]
    private Collection $enseignants;

    public function __construct()
    {
        $this->enseignants = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom_etab; 
    }   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeEtab(): ?string
    {
        return $this->code_etab;
    }

    public function setCodeEtab(string $code_etab): self
    {
        $this->code_etab = $code_etab;

        return $this;
    }

    public function getNomEtab(): ?string
    {
        return $this->nom_etab;
    }

    public function setNomEtab(string $nom_etab): self
    {
        $this->nom_etab = $nom_etab;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEMail(): ?string
    {
        return $this->e_mail;
    }

    public function setEMail(?string $e_mail): self
    {
        $this->e_mail = $e_mail;

        return $this;
    }

    public function getNomProprio(): ?string
    {
        return $this->nom_proprio;
    }

    public function setNomProprio(?string $nom_proprio): self
    {
        $this->nom_proprio = $nom_proprio;

        return $this;
    }

    public function getNomDirecteur(): ?string
    {
        return $this->nom_directeur;
    }

    public function setNomDirecteur(?string $nom_directeur): self
    {
        $this->nom_directeur = $nom_directeur;

        return $this;
    }

    public function getCodeTypeAffiliation(): ?string
    {
        return $this->code_type_affiliation;
    }

    public function setCodeTypeAffiliation(?string $code_type_affiliation): self
    {
        $this->code_type_affiliation = $code_type_affiliation;

        return $this;
    }

    public function getTypeAffiliation(): ?string
    {
        return $this->type_affiliation;
    }

    public function setTypeAffiliation(?string $type_affiliation): self
    {
        $this->type_affiliation = $type_affiliation;

        return $this;
    }

    public function getNIF(): ?string
    {
        return $this->NIF;
    }

    public function setNIF(?string $NIF): self
    {
        $this->NIF = $NIF;

        return $this;
    }

    public function getFokoetab(): ?Fokontany
    {
        return $this->fokoetab;
    }

    public function setFokoetab(?Fokontany $fokoetab): self
    {
        $this->fokoetab = $fokoetab;

        return $this;
    }

    /**
     * @return Collection<int, Enseignant>
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants->add($enseignant);
            $enseignant->setEtabenseignant($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->removeElement($enseignant)) {
            // set the owning side to null (unless already changed)
            if ($enseignant->getEtabenseignant() === $this) {
                $enseignant->setEtabenseignant(null);
            }
        }

        return $this;
    }
}
