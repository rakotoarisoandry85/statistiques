<?php

namespace App\Form;

use App\Entity\Cisco;
use App\Entity\Communes;
use App\Entity\Dren;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class SelectType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
        ->add('dren', EntityType::class, [
            'mapped' => false,
           'class' => Dren::class,
            'choice_label' => 'nom_dren',
            'placeholder' => 'Région',
            'label' => 'Région',
            'required' => false
        ])

        /*->add('ciscos', ChoiceType::class, [
            'placeholder' => 'Département (Choisir CISCO)',
            'required' => false,
           // 'mapped' => false
        ])*/
    
    ;

    $formModifier = function (FormInterface $form, Dren $regions = null) {
        
        $ciscos = null === $regions ? [] : $regions->getCiscos();
        
        $form->add('ciscos', EntityType::class, [
            'class' => Cisco::class,
            'choices' => $ciscos,
            'required' => false,
            'choice_label' => 'nom_cisco',
            'placeholder' => 'Département new (Choisir CISCO)',
            'attr' => ['class' => 'custom-select'],
            'label' => 'CISCO'
        ]);

    };

        /* 
     $user = $event->getData();
        $form = $event->getForm();

        if (!$user) {
            return;
        }
   if (isset($user['showEmail']) && $user['showEmail']) {
        $form->add('email', EmailType::class);
    } else {
        unset($user['email']);
        $event->setData($user);
    }*/
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {

                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                
                $formModifier($event->getForm(), $data);

               if($data!==null)
                    dd($data);
            }
        );

    $builder->get('dren')->addEventListener(
        FormEvents::POST_SUBMIT,
        function (FormEvent $event) use ($formModifier) {
            $region = $event->getForm()->getData();
            $formModifier($event->getForm()->getParent(), $region);

                /*if ($region !== null)
                    var_dump($region);*/
        }
    );
    /**------------------------------------------------------- */
    
      
   }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        //    'data_class' => Select::class,
        ]);
    }
}
