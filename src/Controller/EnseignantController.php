<?php

namespace App\Controller;

use App\Form\EnseignantType;
use App\Repository\EnseignantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class EnseignantController extends AbstractController
{
    #[Route('/enseignant', name: 'app_enseignant')]
    public function index(EnseignantRepository $repoEs,
    Request $request,PaginatorInterface $paginator
    ): Response
    {
        $enseignants = [];
        $enseignants = $repoEs->findAll();
        $nb_enseignants = count($enseignants);
        if($nb_enseignants > 20){
            $enseignants = $paginator->paginate(
            $enseignants, //on passe les données enseignants
            $request->query->getInt('page', 1), //le numero de page en cours, 1 par defaut
            20                              //limite des pages
        );
        //select Enseignant(un select permettant de chercher un nom ou prénom d'un enseignant dans la BD)...
        $form = $this->createForm(EnseignantType::class)->handleRequest($request);

        }      
        return $this->render('enseignant/enseignants.html.twig', [
            'enseignants' => $enseignants,
            'form' => $form->createView(),
        ]);
    }
}
