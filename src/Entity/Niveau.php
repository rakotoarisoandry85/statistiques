<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_niveau = null;

    #[ORM\Column(nullable: true)]
    private ?int $valeurs = null;

    #[ORM\OneToMany(mappedBy: 'niveau', targetEntity: Effectif::class)]
    private Collection $effectifs;


    public function __toString()
    {
        return $this->nom_niveau;
    }

    public function __construct()
    {
      //  $this->effectifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomNiveau(): ?string
    {
        return $this->nom_niveau;
    }

    public function setNomNiveau(string $nom_niveau): self
    {
        $this->nom_niveau = $nom_niveau;

        return $this;
    }

    public function getValeurs(): ?int
    {
        return $this->valeurs;
    }

    public function setValeurs(?int $valeurs): self
    {
        $this->valeurs = $valeurs;

        return $this;
    }

    /**
     * @return Collection<int, Effectif>
     */
    public function getEffectifs(): Collection
    {
        return $this->effectifs;
    }

    public function addEffectif(Effectif $effectif): self
    {
        if (!$this->effectifs->contains($effectif)) {
            $this->effectifs->add($effectif);
            $effectif->setNiveau($this);
        }

        return $this;
    }

    public function removeEffectif(Effectif $effectif): self
    {
        if ($this->effectifs->removeElement($effectif)) {
            // set the owning side to null (unless already changed)
            if ($effectif->getNiveau() === $this) {
                $effectif->setNiveau(null);
            }
        }

        return $this;
    }

   
}
