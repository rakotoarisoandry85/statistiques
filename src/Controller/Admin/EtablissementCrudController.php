<?php

namespace App\Controller\Admin;

use App\Entity\Etablissement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class EtablissementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Etablissement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
           // AssociationField::new('fokoetab', 'Fokotany:'),
            AssociationField::new('fokoetab', 'Fokotany:'),
            TextField::new('code_etab'),
            TextField::new('nom_etab'),
            TextField::new('telephone'),
            TextField::new('e_mail'),
            TextField::new('nom_proprio'),
            TextField::new('nom_directeur'),
            TextField::new('code_type_affiliation'),
            TextField::new('type_affiliation'),
            TextField::new('nif'),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add(TextFilter::new('code_etab','Code Etablissement'))
        ->add(TextFilter::new('nom_etab','Nom Etablissement'))
        ->add(TextFilter::new('nom_proprio','Nom Propriétaire'))

        ;
    }
    
}
