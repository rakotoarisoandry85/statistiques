<?php

namespace App\Controller\Admin;

use App\Entity\Effectif;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class EffectifCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Effectif::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            AssociationField::new('cisco','Cisco')->hideOnForm(),
            AssociationField::new('niveau','Niveau'),
            IntegerField::new('valeur'),
            DateField::new('created_at'),
        ];
    }
// CrudController manala lay erreur pagination...
public function configureCrud(Crud $crud): Crud
{
    return $crud
        ->setPaginatorUseOutputWalkers(true)
    ;
}
    
}
