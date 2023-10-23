<?php

namespace App\Controller\Admin;

use App\Entity\Communes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommunesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Communes::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
            AssociationField::new('ciscom', 'CISCO:'),
            TextField::new('code_commune','code COMMUNE'),
            TextField::new('nom_commune','nom COMMUNE'),
            TextField::new('cat_commune','Catégorie COMMUNE'),
        ];
    }
    
}
