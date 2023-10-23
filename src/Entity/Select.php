<?php

namespace App\Entity;

use App\Repository\SelectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SelectRepository::class)]
#[ORM\Table(name: '`select`')]
class Select
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'selects')]
    private ?Dren $regions = null;

    
    #[ORM\ManyToOne(targetEntity:Cisco::class, inversedBy:'ciscos')]
  //  #[ORM\JoinColumn(nullable:false)]
     
    private ?Cisco $ciscos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegions(): ?Dren
    {
        return $this->regions;
    }

    public function setRegions(?Dren $regions): self
    {
        $this->regions = $regions;

        return $this;
    }
    public function getCiscos(): ?Cisco
    {
        return $this->ciscos;
    }

    public function setCisco(?Cisco $ciscos): self
    {
        $this->ciscos = $ciscos;

        return $this;
    }
}
