<?php

namespace App\Controller\Admin\Dashbodoards;

use App\Controller\Admin\CrudControllers\AboutCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[AdminDashboard(allowedControllers: [AboutCrudController::class])]
class SimpleDashbordController extends AbstractDashboardController
{
    #[Route('/dashboard', name: 'app_simple_admin')]
    public function index(): Response
    {
        return $this->render('pages/admin/welcome.html.twig',[]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Lsodlo Com');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
