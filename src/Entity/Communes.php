<?php

namespace App\Entity;

use App\Repository\CommunesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommunesRepository::class)]
class Communes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_commune = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_commune = null;

    #[ORM\Column(length: 255)]
    private ?string $cat_commune = null;

    #[ORM\ManyToOne(targetEntity: Cisco::class, inversedBy: 'communes')]
    private  $ciscom ;

    #[ORM\OneToMany(mappedBy: 'ciscom', targetEntity: Cisco::class)]
    private Collection $communes;

    public function __construct()
    {
        $this->communes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom_commune;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCommune(): ?string
    {
        return $this->code_commune;
    }

    public function setCodeCommune(string $code_commune): self
    {
        $this->code_commune = $code_commune;

        return $this;
    }

    public function getNomCommune(): ?string
    {
        return $this->nom_commune;
    }

    public function setNomCommune(string $nom_commune): self
    {
        $this->nom_commune = $nom_commune;

        return $this;
    }

    public function getCatCommune(): ?string
    {
        return $this->cat_commune;
    }

    public function setCatCommune(string $cat_commune): self
    {
        $this->cat_commune = $cat_commune;

        return $this;
    }

    public function getCiscom(): ?Cisco
    {
        return $this->ciscom;
    }

    public function setCiscom(?Cisco $ciscom): self
    {
        $this->ciscom = $ciscom;

        return $this;
    }

    /**
     * @return Collection<int, Cisco>
     */
    public function getCommunes(): Collection
    {
        return $this->communes;
    }

   /* public function addCommune(Communes $commune): self
    {
        if (!$this->communes->contains($commune)) {
            $this->communes->add($commune);
            $commune->setCiscom($this);
        }

        return $this;
    }

    public function removeCommune(self $commune): self
    {
        if ($this->communes->removeElement($commune)) {
            // set the owning side to null (unless already changed)
            if ($commune->getCiscom() === $this) {
                $commune->setCiscom(null);
            }
        }

        return $this;
    }*/
}
