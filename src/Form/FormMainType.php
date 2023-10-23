<?php

namespace App\Form;

use App\Entity\Cisco;
use App\Entity\Communes;
use App\Entity\Dren;
use App\Repository\CiscoRepository;
use App\Repository\DrenRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormMainType extends AbstractType
{
   // private $repoDrenVar;
   // private $repoCiscoVar;
    public function __construct(private DrenRepository $repoDren,
    private CiscoRepository $repoCisco
    ){ 
       /* $this->repoDrenVar = $repoDren;
        $this->repoCiscoVar = $repoCisco;*/

    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('regions', EntityType::class, [
            'mapped' => false,
            'class' => Dren::class,
            'choice_label' => 'nom_dren',
            'placeholder' => 'Région',
            'label' => 'Région',
            'required' => false
        ])

        ->add('cisco', ChoiceType::class, [
            'placeholder' => 'CISCO (Choisir le CISCO corespondant!)',
            'mapped' => false,
            'required' => false
        ])     

      //  ->add('Valider', SubmitType::class)
    ;

    $formModifier = function (FormInterface $formB, Dren $regions = null) {
        $ciscos = null === $regions ? [] : $regions->getCiscos();
      // $ciscos = $regions === null ? [] : $this->repoCisco->findByDrenOrderedByAscName($regions);
        $formB->add('cisco', EntityType::class, [
            'class' => Cisco::class,
            'choices' => $ciscos,
            'required' => false,
            'choice_label' => 'nom_cisco',
            'placeholder' => 'Département Nouveau (Choisir le CISCO corespondant!)',
            'attr' => ['class' => 'custom-select'],
            'label' => 'CISCO'
        ]);
    };

    $builder->get('regions')->addEventListener(
        FormEvents::POST_SUBMIT,
        function (FormEvent $event) use ($formModifier) {

            $region = $event->getForm()->getData();
            $formB = $event->getForm()->getParent();
            $formModifier($formB , $region);
        }
    );
   // dd($builder->get('regions'));
            
   }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dren::class,
        ]);
    }
}
