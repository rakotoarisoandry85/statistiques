<?php

namespace App\Form;

use App\Entity\Cisco;
use App\Entity\Communes;
use App\Entity\Dren;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class SelectCommuneType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
        ->add('ciscos', EntityType::class, [
            'mapped' => false,
            'class' => Cisco::class,
            'choice_label' => 'nom_cisco',
            'placeholder' => 'Cisco',
            'label' => 'CISCO',
            'required' => false
        ])

            ->add('communes', EntityType::class, [
                'placeholder' => 'Communes (Choisir CISCO)',
                'class' => Communes::class,
                'required' => false,
                 'mapped' => false
            ])
    ;
    /**------------------------------------------------------- */
        $formModifier = function (FormInterface $form, Cisco $ciscos = null) {

            $communes = null === $ciscos ? [] : $ciscos->getCommunes();

         
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {

                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data);

                if ($data != null)
                    dd($data);
            }
        );

        $builder->get('ciscos')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $cisco = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $cisco);

                if ($cisco === null)
                    dump($cisco);
            }
        );   
   }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            //'data_class' => Select::class,
        ]);
    }
}

