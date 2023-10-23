<?php

namespace App\Entity;

use App\Entity\Communes;
use App\Repository\CiscoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CiscoRepository::class)]
class Cisco
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length: 255)]
    private $code_sisco;

    #[ORM\Column(length: 255)]
    private $nom_cisco;

    #[ORM\ManyToOne(targetEntity: Dren::class, inversedBy: 'ciscos')]
    private $drencisco;


    #[ORM\OneToMany(mappedBy: 'ciscom', targetEntity: Communes::class)]
    private Collection $communes;

   /* #[ORM\OneToMany(mappedBy: 'cisco', targetEntity: Effectif::class)]
    private Collection $effectifs;*/

    /**
     * @ORM\OneToMany(targetEntity=Select::class, mappedBy="ciscos")
     */
  /*  #[ORM\OneToMany(mappedBy: 'ciscos', targetEntity: Select::class)]
    private Collection $selects;*/


    public function __construct()
    {
       // $this->ciscotocommune = new ArrayCollection();
        $this->communes = new ArrayCollection();
       // $this->effectifs = new ArrayCollection();
      // $this->selects = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom_cisco;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeSisco(): ?string
    {
        return $this->code_sisco;
    }

    public function setCodeSisco(string $code_sisco): self
    {
        $this->code_sisco = $code_sisco;

        return $this;
    }

    public function getNomCisco(): ?string
    {
        return $this->nom_cisco;
    }

    public function setNomCisco(string $nom_cisco): self
    {
        $this->nom_cisco = $nom_cisco;

        return $this;
    }

    public function getDrencisco(): ?Dren
    {
        return $this->drencisco;
    }

    public function setDrencisco(?Dren $drencisco): self
    {
        $this->drencisco = $drencisco;

        return $this;
    }

    /**
     * @return Collection<int, Commune>
     */
    public function getCommunes(): Collection
    {
        return $this->communes;
    }

    public function addCommune(Communes $commune): self
    {
        if (!$this->communes->contains($commune)) {
           // $this->ciscos[] = $cisco;
            //$this->communes->add($commune);
            $this->communes[] = $commune;
            $commune->setCiscom($this);

        }

        return $this;
    }

    public function removeCommune(Communes $commune): self
    {
        if ($this->communes->removeElement($commune)) {
            // set the owning side to null (unless already changed)
            if ($commune->getCiscom() === $this) {
                $commune->setCiscom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Effectif>
     */
  /*  public function getEffectifs(): Collection
    {
        return $this->effectifs;
    }

    public function addEffectif(Effectif $effectif): self
    {
        if (!$this->effectifs->contains($effectif)) {
            $this->effectifs->add($effectif);
            $effectif->setCisco($this);
        }

        return $this;
    }

    public function removeEffectif(Effectif $effectif): self
    {
        if ($this->effectifs->removeElement($effectif)) {
            // set the owning side to null (unless already changed)
            if ($effectif->getCisco() === $this) {
                $effectif->setCisco(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, Select>
     */
 /*   public function getSelects(): Collection
    {
        return $this->selects;
    }

    public function addSelect(Select $select): self
    {
        if (!$this->selects->contains($select)) {
            $this->selects->add($select);
            $select->setCisco($this);
        }

        return $this;
    }

    public function removeSelect(Select $select): self
    {
        if ($this->selects->removeElement($select)) {
            // set the owning side to null (unless already changed)
            if ($select->getCiscos() === $this) {
                $select->setCisco(null);
            }
        }

        return $this;
    }
*/

  
}
