<?php

namespace App\Form;

use App\Entity\Cisco;
use App\Entity\Dren;
use App\Repository\CiscoRepository;
use App\Repository\DrenRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface as FormFormInterface;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DrenType extends AbstractType
{
    public function __construct(private CiscoRepository $ciscoRepository){}
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           // ->add('code_dren')
            ->add('nom_dren',EntityType::class, [
                'class' => Dren::class,
                'choice_label' => 'nom_dren',
                'placeholder' => '---- Choisir le nom de la région: ----',
                'query_builder' => fn (DrenRepository $drenRepository) =>
                $drenRepository->findAllOrderedByAscNameQueryBuilder()
            ])
        ;

        $formModifier = function (FormFormInterface $formD, Dren $dren = null) {
            $cisco = $dren === null ? [] : $this->ciscoRepository->findByCountryOrderedByAscName($dren);
//dd($cisco);
            $formD->add('ciscos');
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
               // dd($data);
              // dd($event);
                $formModifier($event->getForm(), $data->getNomDren());
               // dd($formModifier);
            }
        );

        $builder->get('nom_dren')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $region = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $region);
                dd($formModifier);
            }
        );

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dren::class,
        ]);
    }
}
