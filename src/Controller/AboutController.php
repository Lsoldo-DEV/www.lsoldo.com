<?php

namespace App\Controller;

use App\Repository\AboutRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(Request $request,AboutRepository $aboutRepository,): Response
    {

        return $this->render('pages/about/index.html.twig', [
            'about' => $aboutRepository->findAbout( $request->get('_locale')),

        ]);
    }
}
