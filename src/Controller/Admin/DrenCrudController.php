<?php

namespace App\Controller\Admin;

use App\Entity\Dren;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class DrenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dren::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('code_dren'),
            TextField::new('nom_dren'),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add(TextFilter::new('code_dren','Selon le code Dren!'))
        ->add(TextFilter::new('nom_dren','Le nom de la région!'));
    }
    
}
