<?php

namespace App\Controller\Admin;

use App\Entity\Cisco;
use App\Entity\Communes;
use App\Entity\Dren;
use App\Entity\Effectif;
use App\Entity\Enseignant;
use App\Entity\Etablissement;
use App\Entity\Fokontany;
use App\Entity\Niveau;
use App\Entity\Secteur;
use App\Entity\Zaps;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardStatController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Statistiques');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Aller sur le site', 'fa fa-undo','app_home');
        yield MenuItem::linkToCrud('Régions', 'fas fa-list', Dren::class);
        yield MenuItem::linkToCrud('CISCO', 'fas fa-list', Cisco::class);
        yield MenuItem::linkToCrud('Commune', 'fas fa-list', Communes::class);
        yield MenuItem::linkToCrud('ZAP', 'fas fa-list', Zaps::class);
        yield MenuItem::linkToCrud('Fokotany', 'fas fa-list', Fokontany::class);
        yield MenuItem::linkToCrud('Etablissement', 'fas fa-list', Etablissement::class);
        yield MenuItem::linkToCrud('Enseignant', 'fas fa-user', Enseignant::class);
        yield MenuItem::linkToCrud('Niveau', 'fas fa-list', Niveau::class);
        yield MenuItem::linkToCrud('Effectif', 'fas fa-list', Effectif::class);
        yield MenuItem::linkToCrud('Secteur', 'fas fa-list', Secteur::class);
      
    }
}
