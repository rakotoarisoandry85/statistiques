<?php

namespace App\Form;

use App\Entity\Cisco;
use App\Entity\Dren;
use App\Repository\CiscoRepository;
use App\Repository\DrenRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CiscoType extends AbstractType
{
    public function __construct(private CiscoRepository $ciscoRepository){}
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //$builder
            //->add('code_sisco')
            //->add('nom_cisco')
         //   ->add('drencisco')
       // ;
       $formModifier = function (FormInterface $form, Dren $dren = null) {
        $cisco = $dren === null ? [] : $this->ciscoRepository->findByCountryOrderedByAscName($dren);
        dd($cisco);
        $form->add('nom_cisco', EntityType::class, [
            'class' => Cisco::class,
            'choice_label' => 'nom_cisco',
            'disabled' => $dren === null,
            'placeholder' => 'Choisir  Cisco',
            'choices' => $cisco
        ]);
    };

  /*  $builder->addEventListener(
        FormEvents::PRE_SET_DATA,
        function (FormEvent $event) use ($formModifier) {
            $data = $event->getData();

            $formModifier($event->getForm(), $data->getNomDren());
        }
    );

    $builder->get('nom_cisco')->addEventListener(
        FormEvents::POST_SUBMIT,
        function (FormEvent $event) use ($formModifier) {
            $region = $event->getForm()->getData();

            $formModifier($event->getForm()->getParent(), $region);
        }
    );*/


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cisco::class,
        ]);
    }
}
