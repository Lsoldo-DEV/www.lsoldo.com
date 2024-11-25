<?php

namespace App\Twig;

use App\Entity\Category;
use App\Entity\Description;
use App\Entity\MailSubscribe;
use App\Entity\Project;
use App\Entity\Realization;
use App\Entity\Service;
use App\Entity\ServiceDescription;
use App\Entity\User;
use App\Form\MailSubscribeType;
use App\Utils\Constant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FunctionExtension extends AbstractExtension
{
    public function __construct(private Environment $environment,
                                private FormFactoryInterface $formFactory,
                                private UrlGeneratorInterface $router,
                                private Security $security,

                                private EntityManagerInterface $em,){}
    public function getFunctions():array
    {
        return[
            new TwigFunction('getServiceDescription', [$this, 'getServiceDescription']),

        ];
    }
    public function getServiceDescription(string $lang=Constant::DEFAULT_DESCRIPTION_LANGUAGE,Service $entity=null): ?ServiceDescription
    {
        if($entity === null) {
            return null;}
        $repo = $this->em->getRepository(ServiceDescription::class);
        return $repo->getDescription($entity,$lang);



    }

}