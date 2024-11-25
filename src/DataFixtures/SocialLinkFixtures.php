<?php

namespace App\DataFixtures;

use App\Entity\SocialLink;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SocialLinkFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $socialLinks = [
            [
                'facebookPage' => 'https://facebook.com/company1',
                'tweeterPage' => 'https://twitter.com/company1',
                'instagramPage' => 'https://instagram.com/company1',
                'whatsapp' => '1234567890',
                'other' => 'https://linkedin.com/company1',
                'createdAt' => new \DateTime('2024-01-01 10:00:00'),
                'editedAt' => null,
            ],
        ];

        foreach ($socialLinks as $linkData) {
            $socialLink = new SocialLink();
            $socialLink->setFacebookPage($linkData['facebookPage']);
            $socialLink->setTweeterPage($linkData['tweeterPage']);
            $socialLink->setInstagramPage($linkData['instagramPage']);
            $socialLink->setWhatsapp($linkData['whatsapp']);
            $socialLink->setOther($linkData['other']);
            $socialLink->setCreatedAt($linkData['createdAt']);
            $socialLink->setEditedAt($linkData['editedAt']);

            $manager->persist($socialLink);
        }

        $manager->flush();
    }
}
