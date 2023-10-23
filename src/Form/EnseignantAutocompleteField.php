<?php

namespace App\Form;

use App\Entity\Enseignant;
use App\Repository\EnseignantRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class EnseignantAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Enseignant::class,
            'placeholder' => 'Choose a Enseignant',
            'choice_label' => 'nom_prenoms',

            'query_builder' => function(EnseignantRepository $enseignantRepository) {
                return $enseignantRepository->createQueryBuilder('enseignant');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
