<?php

namespace App\Entity;

use App\Repository\SecteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecteurRepository::class)]
class Secteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_secteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSecteur(): ?string
    {
        return $this->nom_secteur;
    }

    public function setNomSecteur(string $nom_secteur): self
    {
        $this->nom_secteur = $nom_secteur;

        return $this;
    }
}
