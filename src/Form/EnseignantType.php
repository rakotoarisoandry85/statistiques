<?php

namespace App\Form;

use App\Entity\Enseignant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /*->add('cin')
            ->add('passport')           
            ->add('date_naissance')
            ->add('code_district_naiss')
            ->add('sexe')
            ->add('code_fonction')
            ->add('code_statut')
            ->add('statut')
            ->add('agent_etat_admin')
            ->add('foko_enseignant')
            ->add('etabenseignant')*/
            ->add('nom_prenoms',  EnseignantAutocompleteField::class, [
                'label' => 'Taper le nom ou prénom pour la recherche:',
                'attr' => [
                    'requied' => true,
                    'placeholder' => 'Entrer le nom ou le prénom de la personne...'
                ]
            ]);
            
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enseignant::class,
        ]);
    }
}
