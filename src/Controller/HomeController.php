<?php

namespace App\Controller;

use App\Entity\Breadcrumb;
use App\Repository\ServiceRepository;
use App\Repository\SocialLinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', requirements: ['_locale' => 'en|es|fr'])]
class HomeController extends AbstractController
{
    public function index(ServiceRepository $serviceRepository,SocialLinkRepository $linkRepository): Response
    {

        $services = $serviceRepository->findAll();
        $link = $linkRepository->findOneBy([], ['id' => 'DESC']);
        $breadcrumbs = new Breadcrumb(new ArrayCollection([]),'Home');
        return $this->render('pages/home/index.html.twig', [
            'breadcrumbs' => $breadcrumbs,
            'services' => $services,
            'link' => $link
        ]);
    }


}
