<?php

namespace App\Controller;

use App\Entity\Cisco;
use App\Entity\Communes;
use App\Entity\Dren;
use App\Form\CiscoType;
use App\Form\CommuneType;
use App\Form\DrenType;
use App\Form\FormMainType;
use App\Form\SelectCommuneType;
use App\Form\SelectType;
use App\Repository\CiscoRepository;
use App\Repository\CommunesRepository;
use App\Repository\DrenRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;

class StatMainController extends AbstractController
{
    /**
     * @Route("/", name="app_stat_main")
     */
    #[Route('/liste_commune', name: 'app_liste_commune', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        //$form = $this->createForm(SelectType::class , $dren);
        $form = $this->createForm(SelectType::class)->handleRequest($request);
        $formC = $this->createForm(SelectCommuneType::class)->handleRequest($request);
        // $form->handleRequest($request);
       // $form2 = $this->createForm(FormMainType::class )->handleRequest($request);
        return $this->render('stat_main/index.html.twig', [
           // 'dren' => $dren,
           /*ici pour ->render(...); */
            //'form' => $form->createView(),
            'form' => $form->createView(),
            'formC' => $formC->createView(),
            /*ici pour ->renderForm(...); */
           // 'form' => $form,
           // 'formCisco'=> $formCisco,
        ]);
    }

  
}
