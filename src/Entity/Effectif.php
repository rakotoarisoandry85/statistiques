<?php

namespace App\Entity;

use App\Repository\EffectifRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EffectifRepository::class)]
class Effectif
{
   /* #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;*/
   // #[ORM\Id]
   // #[ORM\Column]
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: Cisco::class,inversedBy: 'effectifs')]
    private ?Cisco $cisco = null;

    #[ORM\Id]
    //#[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Niveau::class,inversedBy: 'effectifs')]
    #[ORM\JoinColumn(nullable: false)]
   // #[Id, ManyToOne(targetEntity: Product::class)]
    private ?Niveau $niveau = null;

    #[ORM\Column]
    private ?int $valeur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?int $total = null; 

  /*  public function getId(): ?int
    {
        return $this->id;
    }*/

    public function getCisco(): ?Cisco
    {
        return $this->cisco;
    }

    public function setCisco(?Cisco $cisco): self
    {
        $this->cisco = $cisco;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

        return $this;
    }

   
}
