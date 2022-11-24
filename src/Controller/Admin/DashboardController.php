<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use App\Entity\Tender;
use App\Entity\Article;
use App\Entity\Project;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ProjectCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ProjectCrudController::class)->generateUrl();

        return $this->redirect($url);

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
            ->setTitle('Taggast');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        //yield MenuItem::linkToLogout('Déconnexion', 'fa fa-sign-out');
        
       // yield MenuItem::section('Utilisateurs');
       // yield MenuItem::linkToCrud('Membres', 'fa fa-user', Member::class);
       // yield MenuItem::linkToCrud('Article', 'fa fa-edit-book', Article::class);
       // yield MenuItem::linkToCrud('Appels d\'offre', 'fa fa-list', Tender::class);
       // yield MenuItem::linkToCrud('Les Projets', 'fa fa-list', Project::class);
        yield MenuItem::linktoRoute('Retour Accueil', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('Membres', 'fa fa-user', Member::class);
        yield MenuItem::linkToCrud('Article', 'fa fa-edit', Article::class);
        yield MenuItem::linkToCrud('Appels d\'offre', 'fa fa-list', Tender::class);
        yield MenuItem::linkToCrud('Les Projets', 'fa fa-list', Project::class);
    }
}
