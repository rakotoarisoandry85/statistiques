<?php

namespace App\Entity;

use App\Repository\VillageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VillageRepository::class)]
class Village
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_village = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVillage(): ?string
    {
        return $this->nom_village;
    }

    public function setNomVillage(string $nom_village): self
    {
        $this->nom_village = $nom_village;

        return $this;
    }
}
