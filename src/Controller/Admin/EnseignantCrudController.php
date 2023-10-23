<?php

namespace App\Controller\Admin;

use App\Entity\Enseignant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EnseignantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enseignant::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
           //association entre fokontany et enseignant...
           AssociationField::new('foko_enseignant','Fokontany'),
           //association entre fokontany et etablissement(fokoetab,etabenseignant)...
           AssociationField::new('etabenseignant','Etablissement'),
           TextField::new('cin'),
           TextField::new('passport'),
           TextField::new('nom_prenoms','Nom et Prénom'),
           TextField::new('date_naissance', 'Date de naissance'),
           TextField::new('code_district_naiss'),
           TextField::new('sexe'),
           TextField::new('code_statut'),
           TextField::new('statut'),
           TextField::new('agent_etat_admin'),
        ];
    }
    
}
