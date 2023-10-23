<?php

namespace App\Entity;

use App\Repository\ZapsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZapsRepository::class)]
class Zaps
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_zap = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_zap = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Communes $zapcom = null;

    #[ORM\OneToMany(mappedBy: 'zapfoko', targetEntity: Fokontany::class)]
    private Collection $fokontanies;

    public function __construct()
    {
        $this->fokontanies = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->nom_zap;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeZap(): ?string
    {
        return $this->code_zap;
    }

    public function setCodeZap(string $code_zap): self
    {
        $this->code_zap = $code_zap;

        return $this;
    }

    public function getNomZap(): ?string
    {
        return $this->nom_zap;
    }

    public function setNomZap(string $nom_zap): self
    {
        $this->nom_zap = $nom_zap;

        return $this;
    }

    public function getZapcom(): ?Communes
    {
        return $this->zapcom;
    }

    public function setZapcom(?Communes $zapcom): self
    {
        $this->zapcom = $zapcom;

        return $this;
    }

    /**
     * @return Collection<int, Fokontany>
     */
    public function getFokontanies(): Collection
    {
        return $this->fokontanies;
    }

    public function addFokontany(Fokontany $fokontany): self
    {
        if (!$this->fokontanies->contains($fokontany)) {
            $this->fokontanies->add($fokontany);
            $fokontany->setZapfoko($this);
        }

        return $this;
    }

    public function removeFokontany(Fokontany $fokontany): self
    {
        if ($this->fokontanies->removeElement($fokontany)) {
            // set the owning side to null (unless already changed)
            if ($fokontany->getZapfoko() === $this) {
                $fokontany->setZapfoko(null);
            }
        }

        return $this;
    }
}
