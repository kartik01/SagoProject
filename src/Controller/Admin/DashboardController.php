<?php

namespace App\Controller\Admin;

use App\Entity\PricingPlan;
use App\Entity\PricingPlanBenefit;
use App\Entity\PricingPlanFeature;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $url = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($url->setController(PricingPlanCrudController::class)->generateUrl());
        
        // return $this->render('admin/dashboard.html.twig');
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
            ->setTitle('Admin');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToRoute('Dashboard', 'fa fa-home', 'admin');
        yield MenuItem::linkToCrud('Pricing Plans', 'fas fa-list', PricingPlan::class);
        yield MenuItem::linkToCrud('Pricing Plan Benefits', 'fas fa-list', PricingPlanBenefit::class);
        yield MenuItem::linkToCrud('Pricing Plan Features', 'fas fa-list', PricingPlanFeature::class);
    }
}
