<?php

namespace App\Entity;

use App\Repository\FokontanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FokontanyRepository::class)]
class Fokontany
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length: 255)]
    private $code_fokontany;

    #[ORM\Column(length: 255)]
    private $nom_fokontany;

    #[ORM\OneToMany(mappedBy: 'fokoetab', targetEntity: Etablissement::class)]
    private Collection $etablissements;

    #[ORM\ManyToOne(inversedBy: 'fokontanies')]
    private ?Zaps $zapfoko = null;

    #[ORM\OneToMany(mappedBy: 'foko_enseignant', targetEntity: Enseignant::class)]
    private Collection $enseignants;
    
    /*#[ORM\Column(length: 10)]
    private ?int $zapfokoid;
*/
    public function __construct()
    {
        $this->etablissements = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->nom_fokontany;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
// Provisoire...
    public function setetId(int $id): self
    {
         $this->id = $id;

         return $this;
    }

    public function getCodeFokontany(): ?string
    {
        return $this->code_fokontany;
    }

    public function setCodeFokontany(string $code_fokontany): self
    {
        $this->code_fokontany = $code_fokontany;

        return $this;
    }

    public function getNomFokontany(): ?string
    {
        return $this->nom_fokontany;
    }

    public function setNomFokontany(string $nom_fokontany): self
    {
        $this->nom_fokontany = $nom_fokontany;

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissements(): Collection
    {
        return $this->etablissements;
    }

    public function addEtablissement(Etablissement $etablissement): self
    {
        if (!$this->etablissements->contains($etablissement)) {
            $this->etablissements->add($etablissement);
            $etablissement->setFokoetab($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): self
    {
        if ($this->etablissements->removeElement($etablissement)) {
            // set the owning side to null (unless already changed)
            if ($etablissement->getFokoetab() === $this) {
                $etablissement->setFokoetab(null);
            }
        }

        return $this;
    }

    public function getZapfoko(): ?Zaps
    {
        return $this->zapfoko;
    }

    public function setZapfoko(?Zaps $zapfoko): self
    {
        $this->zapfoko = $zapfoko;

        return $this;
    }
    
   /* public function getZapfokoId(): ?int
    {
        return $this->zapfokoid;
    }
*/

    /*public function setZapfokoId(?int $zapfoko): self
    {
        $this->zapfokoid = $zapfoko;

        return $this;
    }*/

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
            $enseignant->setFokoEnseignant($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->removeElement($enseignant)) {
            // set the owning side to null (unless already changed)
            if ($enseignant->getFokoEnseignant() === $this) {
                $enseignant->setFokoEnseignant(null);
            }
        }

        return $this;
    }
}
