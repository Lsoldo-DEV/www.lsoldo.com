<?php

namespace App\Twig\Components;

use App\Repository\ServiceRepository;
use App\Repository\SocialLinkRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Footer
{
    public array $services;
    public $link;
    public function __construct(ServiceRepository $serviceRepository,
                                SocialLinkRepository $linkRepository){
        $this->services = $serviceRepository->findAll();
        $this->link = $linkRepository->findOneBy([], ['id' => 'DESC']);
    }
}
