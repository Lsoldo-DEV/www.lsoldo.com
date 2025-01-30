<?php

namespace App\Controller\Admin\Dashbodoards;

use App\Entity\About;
use App\Entity\FAQ;
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
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('pages/admin/welcome.html.twig',[]);
        }
        elseif ($this->isGranted('ROLE_MANAGER')) {
            return $this->redirectToRoute('app_simple_admin');
        }else{
            return $this->redirectToRoute('app_login');
        }
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
    
        yield MenuItem::section('Services');
        yield MenuItem::linkToCrud('Services', 'fa fa-cogs', Service::class);
        yield MenuItem::linkToCrud('ServiceDescription', 'fa fa-info-circle', ServiceDescription::class);
        yield MenuItem::linkToCrud('ReasonToChooseYou', 'fa fa-thumbs-up', ReasonToChooseYou::class);
    
        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class)
            ->setPermission('ROLE_ADMIN');
        
        yield MenuItem::section('App settings');
        yield MenuItem::linkToCrud('Testimonials', 'fa fa-comments', Testmonial::class);
        yield MenuItem::linkToCrud('About', 'fa fa-info-circle', About::class);
        yield MenuItem::linkToCrud('FAQ', 'fa fa-circle-question', FAQ::class);
        yield MenuItem::linkToCrud('Socials', 'fa fa-share-alt', SocialLink::class);
        yield MenuItem::linkToCrud('Projects', 'fa fa-folder-open', Project::class);
        yield MenuItem::linkToCrud('ProjectsFile', 'fa fa-file', ProjectFile::class);
        yield MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class);
        yield MenuItem::linkToCrud('General', 'fa fa-cog', SettingsOption::class);
    }
}
