<?php

namespace App\Controller\Admin;

use App\Entity\Fokontany;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FokontanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fokontany::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
            AssociationField::new('zapfoko', 'ZAP:'),
            TextField::new('code_fokontany'),
            TextField::new('nom_fokontany'),
        ];
    }
    
}
