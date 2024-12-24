<?php

namespace App\Controller;

use App\Entity\Breadcrumb;
use App\Repository\AboutRepository;
use App\Repository\ClientImgRepository;
use App\Repository\ServiceRepository;
use App\Repository\SettingsOptionRepository;
use App\Repository\SocialLinkRepository;
use App\Repository\TestmonialRepository;
use App\Utils\Constant;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', requirements: ['_locale' => 'en|es|fr'])]
class HomeController extends AbstractController
{
    public function __construct(
        private  SettingsOptionRepository $optionRepository
    ){}
    public function index(Request $request,ServiceRepository $serviceRepository,SocialLinkRepository $linkRepository,
                          AboutRepository $aboutRepository,ClientImgRepository $clientImgRepository,
    TestmonialRepository $testmonialRepository): Response
    {
       // ob_start();
        //phpinfo();
        //$phpinfo = ob_get_clean();

        //return new Response($phpinfo);
        $services = $serviceRepository->findAll();
        $link = $linkRepository->findOneBy([], ['id' => 'DESC']);
        $breadcrumbs = new Breadcrumb(new ArrayCollection([]),'Home');
        $clientsLogo = $clientImgRepository->findAll();
        $testmonials =  $testmonialRepository->findAll();
        $titleArray = Constant::getTitleAndSubTitle($this->optionRepository,$request,[
            Constant::APP_LABEL_HOME_TITLE,
            Constant::APP_LABEL_HOME_TITLE1,
            Constant::APP_LABEL_HOME_TITLE2,
            Constant::APP_LABEL_HOME_SUBTITLE,
            Constant::APP_LABEL_SERVICE_TITLE,
            Constant::APP_LABEL_SERVICE_SUBTITLE]);
        return $this->render('pages/home/index.html.twig', [
            'breadcrumbs' => $breadcrumbs,
            'services' => $services,
            'link' => $link,
            "title_part0"=>$titleArray[0],
            "title_part1"=>$titleArray[1],
            "title_part2"=>$titleArray[2],
            "subtitle"=>$titleArray[3],
            "service_title"=>$titleArray[4],
            "service_subtitle"=>$titleArray[5],
            'about' => $aboutRepository->findAbout( $request->get('_locale')),
            "clientsLogo"=>$clientsLogo,
            "testmonials" => $testmonials,
        ]);
    }


}
