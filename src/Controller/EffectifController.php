<?php

namespace App\Controller;

use App\Entity\Effectif;
use App\Form\EffectifType;
use App\Repository\EffectifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/effectif')]
class EffectifController extends AbstractController
{
    #[Route('/', name: 'app_effectif_index', methods: ['GET']) ]
    public function index(EffectifRepository $effectifRepository): Response
    {
        $allEffectif = $effectifRepository->findAll();
       // dd($allEffectif);
        return $this->render('effectif/index.html.twig', [
            'effectifs' => $allEffectif,
        ]);
    }

    #[Route('/new', name: 'app_effectif_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EffectifRepository $effectifRepository): Response
    {
        $effectif = new Effectif();
        $form = $this->createForm(EffectifType::class, $effectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $effectifRepository->save($effectif, true);

            return $this->redirectToRoute('app_effectif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('effectif/new.html.twig', [
            'effectif' => $effectif,
            'form' => $form,
        ]);
    }

    #[Route('/{niveau}', name: 'app_effectif_show', methods: ['GET'])]
    public function show(Effectif $effectif): Response
    {
        return $this->render('effectif/show.html.twig', [
            'effectif' => $effectif,
        ]);
    }

    #[Route('/{niveau}/edit', name: 'app_effectif_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Effectif $effectif, EffectifRepository $effectifRepository): Response
    {
        $form = $this->createForm(EffectifType::class, $effectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $effectifRepository->save($effectif, true);

            return $this->redirectToRoute('app_effectif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('effectif/edit.html.twig', [
            'effectif' => $effectif,
            'form' => $form,
        ]);
    }

    #[Route('/{niveau}', name: 'app_effectif_delete', methods: ['POST'])]
    public function delete(Request $request, Effectif $effectif, EffectifRepository $effectifRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$effectif->getNiveau(), $request->request->get('_token'))) {
            $effectifRepository->remove($effectif, true);
        }

        return $this->redirectToRoute('app_effectif_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
