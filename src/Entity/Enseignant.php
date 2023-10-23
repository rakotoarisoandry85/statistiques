<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseignantRepository::class)]
class Enseignant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passport = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_prenoms = null;

    #[ORM\Column(nullable: true)]
    private ?string $date_naissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_district_naiss = null;

    #[ORM\Column(length: 255)]
    private ?string $sexe = null;

    #[ORM\Column(length: 255)]
    private ?string $code_fonction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_statut = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\Column( nullable: true)]
    private ?string $agent_etat_admin = null;

    #[ORM\ManyToOne(inversedBy: 'enseignants')]
    private ?Fokontany $foko_enseignant = null;

    #[ORM\ManyToOne(inversedBy: 'enseignants')]
    private ?Etablissement $etabenseignant = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(?string $passport): self
    {
        $this->passport = $passport;

        return $this;
    }

    public function getNomPrenoms(): ?string
    {
        return $this->nom_prenoms;
    }

    public function setNomPrenoms(string $nom_prenoms): self
    {
        $this->nom_prenoms = $nom_prenoms;

        return $this;
    }

    public function getDateNaissance(): ?string
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?string $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getCodeDistrictNaiss(): ?string
    {
        return $this->code_district_naiss;
    }

    public function setCodeDistrictNaiss(?string $code_district_naiss): self
    {
        $this->code_district_naiss = $code_district_naiss;

        return $this;
    }

    public function isSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getCodeFonction(): ?string
    {
        return $this->code_fonction;
    }

    public function setCodeFonction(string $code_fonction): self
    {
        $this->code_fonction = $code_fonction;

        return $this;
    }

    public function getCodeStatut(): ?string
    {
        return $this->code_statut;
    }

    public function setCodeStatut(?string $code_statut): self
    {
        $this->code_statut = $code_statut;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getAgentEtatAdmin(): ?string
    {
        return $this->agent_etat_admin;
    }

    public function setAgentEtatAdmin(?string $agent_etat_admin): self
    {
        $this->agent_etat_admin = $agent_etat_admin;

        return $this;
    }

    public function getFokoEnseignant(): ?Fokontany
    {
        return $this->foko_enseignant;
    }

    public function setFokoEnseignant(?Fokontany $foko_enseignant): self
    {
        $this->foko_enseignant = $foko_enseignant;

        return $this;
    }

    public function getEtabenseignant(): ?Etablissement
    {
        return $this->etabenseignant;
    }

    public function setEtabenseignant(?Etablissement $etabenseignant): self
    {
        $this->etabenseignant = $etabenseignant;

        return $this;
    }

    

    
}
