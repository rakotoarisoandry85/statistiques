<?php

namespace App\Entity;

use App\Repository\DrenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DrenRepository::class)]
class Dren
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length: 255)]
    private $code_dren;

    #[ORM\Column(length: 255)]
    private $nom_dren;

    #[ORM\OneToMany(targetEntity: Cisco::class, mappedBy: 'drencisco')]
   // @ORM\OneToMany(targetEntity=Cisco::class, mappedBy="drencisco",cascade={"persist"})
    private  Collection $ciscos;

    #[ORM\OneToMany(mappedBy: 'regions', targetEntity: Select::class)]
    private Collection $selects;

    public function __construct()
    {
        $this->ciscos = new ArrayCollection();
        $this->selects = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom_dren;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeDren(): ?string
    {
        return $this->code_dren;
    }

    public function setCodeDren(string $code_dren): self
    {
        $this->code_dren = $code_dren;

        return $this;
    }

    public function getNomDren(): ?string
    {
        return $this->nom_dren;
    }

    public function setNomDren(string $nom_dren): self
    {
        $this->nom_dren = $nom_dren;

        return $this;
    }

    /**
     * @return Collection |Cisco[]
     */
    public function getCiscos(): Collection
    {
        return $this->ciscos;
    }

    public function addCisco(Cisco $cisco): self
    {
        if (!$this->ciscos->contains($cisco)) {
            $this->ciscos[] = $cisco;
            $cisco->setDrencisco($this);
        }

        return $this;
    }

    public function removeCisco(Cisco $cisco): self
    {
        if ($this->ciscos->removeElement($cisco)) {
            // set the owning side to null (unless already changed)
            if ($cisco->getDrencisco() === $this) {
                $cisco->setDrencisco(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Select>
     */
    public function getSelects(): Collection
    {
        return $this->selects;
    }

    public function addSelect(Select $select): self
    {
        if (!$this->selects->contains($select)) {
            $this->selects->add($select);
            $select->setRegions($this);
        }

        return $this;
    }

    public function removeSelect(Select $select): self
    {
        if ($this->selects->removeElement($select)) {
            // set the owning side to null (unless already changed)
            if ($select->getRegions() === $this) {
                $select->setRegions(null);
            }
        }

        return $this;
    }
}
