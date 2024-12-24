<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use App\Repository\SettingsOptionRepository;
use App\Repository\SocialLinkRepository;
use App\Utils\Constant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/qrcode')]
class ServiceController extends AbstractController
{
    public function __construct(private readonly ServiceRepository $serviceRepository)
    {
    }

    #[Route(name: 'app_service_index', methods: ['GET'])]
    public function index(Request $request,SettingsOptionRepository $optionRepository): Response
    {
        $titleArray = Constant::getTitleAndSubTitle($optionRepository,$request,[
            Constant::APP_LABEL_SERVICE_TITLE,
            Constant::APP_LABEL_SERVICE_SUBTITLE]);
        $services = $this->serviceRepository->findAll();
        return $this->render('pages/service/index.html.twig', [
            'services' => $services,
            "service_title"=>$titleArray[0],
            "service_subtitle"=>$titleArray[1],
        ]);
    }
    #[Route('/{id}', name: 'app_service_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Service $service,SocialLinkRepository $linkRepository): Response
    {
        $services = $this->serviceRepository->findAll();
        $link = $linkRepository->findOneBy([], ['id' => 'DESC']);
        return $this->render('pages/service/show.html.twig', [
            'service' => $service,
            'services' => $services,
            'link' => $link,
        ]);
    }
}
