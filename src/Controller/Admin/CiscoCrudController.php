<?php

namespace App\Controller\Admin;

use App\Entity\Cisco;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CiscoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cisco::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
            AssociationField::new('drencisco', 'Région:'),
            TextField::new('code_sisco','Code CISCO'),
            TextField::new('nom_cisco','Nom CISCO'),
        ];
    }
    
}
