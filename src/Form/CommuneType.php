<?php

namespace App\Form;

use App\Entity\Communes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommuneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           // ->add('code_commune')
           // ->add('nom_commune')
            //->add('cat_commune')
            ->add('ciscom', null, [
                'label' => 'CISCO',
                'attr' => [
                    'requied' => true,
                    'placeholder' => 'Entrer le nom d\'un article'
                ]
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Communes::class,
        ]);
    }
}
