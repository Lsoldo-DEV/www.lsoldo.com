<?php

namespace App\Controller\Admin\Dashbodoards;

use App\Entity\About;
use App\Entity\Project;
use App\Entity\ProjectFile;
use App\Entity\ReasonToChooseYou;
use App\Entity\Service;
use App\Entity\ServiceDescription;
use App\Entity\SettingsOption;
use App\Entity\SocialLink;
use App\Entity\Tag;
use App\Entity\Testmonial;
use App\Entity\User;
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
        ->setTitle('<a href="' . $this->generateUrl('app_home') . '" style="text-decoration: none;">'
            . '<img src="/logo_tls.webp"></a>')
        ->renderContentMaximized()

        ->generateRelativeUrls()
        ->setFaviconPath("logo_tls.webp")
        ->setLocales([
            'en' => '🇬🇧 English',
            'fr' => '🇫🇷 Français'
        ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        yield MenuItem::section('Services');
        yield MenuItem::linkToCrud('Services', 'fa fa-cogs', Service::class);
        yield MenuItem::linkToCrud('ServiceDescription', 'fa fa-info-circle', ServiceDescription::class);
        yield MenuItem::linkToCrud('ReasonToChooseYou', 'fa fa-thumbs-up', ReasonToChooseYou::class);
    
        
        yield MenuItem::section('App settings');
        yield MenuItem::linkToCrud('Testimonials', 'fa fa-comments', Testmonial::class);
        yield MenuItem::linkToCrud('About', 'fa fa-info-circle', About::class);
        yield MenuItem::linkToCrud('Socials', 'fa fa-share-alt', SocialLink::class);
        yield MenuItem::linkToCrud('Projects', 'fa fa-folder-open', Project::class);
        yield MenuItem::linkToCrud('ProjectsFile', 'fa fa-file', ProjectFile::class);
        yield MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class);
        yield MenuItem::linkToCrud('General', 'fa fa-cog', SettingsOption::class);
    }
}









