<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Entity\Fds;
use App\Entity\Customers;
use Symfony\Component\HttpFoundation\Response;
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
        //return parent::index(); 
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
    // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductsCrudController::class)->generateUrl());

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
            ->setTitle('Projet M2 GED');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('ChemicalBrothers', 'fa fa-home');
        yield MenuItem::linkToCrud('Products', '', Products::class);
        yield MenuItem::linkToCrud('FDS', '', Fds::class);
        yield MenuItem::linkToCrud('Customers', '', Customers::class);
    }
}
