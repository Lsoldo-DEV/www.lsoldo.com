<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\FAQRepository;
use App\Repository\ServiceRepository;
use App\Repository\SettingsOptionRepository;
use App\Repository\SocialLinkRepository;
use App\Utils\Constant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/service')]
class ServiceController extends AbstractController
{
    public function __construct(private readonly ServiceRepository $serviceRepository)
    {
    }

    #[Route(name: 'app_service_index', methods: ['GET'])]
    public function index(Request $request,SettingsOptionRepository $optionRepository, FAQRepository $faqRepository): Response
    {
        $titleArray = Constant::getTitleAndSubTitle($optionRepository,$request,[
            Constant::APP_LABEL_SERVICE_TITLE,
            Constant::APP_LABEL_SERVICE_SUBTITLE]);
        $services = $this->serviceRepository->findAll();
        return $this->render('pages/service/index.html.twig', [
            'services' => $services,
            "service_title"=>$titleArray[0],
            "service_subtitle"=>$titleArray[1],
            "faqs" => $faqRepository->findAllOrderedByLang($request->get('_locale'))
        ]);
    }
    #[Route('/{id}', name: 'app_service_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Service $service, Request $request, SocialLinkRepository $linkRepository, FAQRepository $FAQRepository): Response
    {
        $services = $this->serviceRepository->findAll();
        $link = $linkRepository->findOneBy([], ['id' => 'DESC']);
        $faqs = $FAQRepository->findAllOrderedByLang($request->get('_locale'));
        return $this->render('pages/service/show.html.twig', [
            'service' => $service,
            'services' => $services,
            'link' => $link,
            'faqs' => $faqs,
        ]);
    }
}
