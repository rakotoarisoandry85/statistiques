<?php

namespace App\Controller\Admin;

use App\Entity\Zaps;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ZapsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Zaps::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),zapcom
            AssociationField::new('zapcom','Commune!'),
            TextField::new('code_zap'),
            TextField::new('nom_zap'),
        ];
    }
    
}
