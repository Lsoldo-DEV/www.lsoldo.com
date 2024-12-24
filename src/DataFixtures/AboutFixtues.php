<?php

namespace App\DataFixtures;

use App\Entity\About;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AboutFixtues extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $about = new About();
        $about->setTitle('À propos de nous')
            ->setSubTitleMessage('Un message inspirant en sous-titre.')
            ->setBodyTitle('Notre histoire')
            ->setBodySubTitle('Ce qui nous motive')
            ->setBenefits(['Qualité', 'Innovation', 'Service'])
            ->setEndPageTitle('Conclusion')
            ->setEndPageText('Merci pour votre intérêt à notre sujet.')
            ->setServicesStats(['clients satisfaits' => 300,'projets' => 120, 'complete project'=>50,'years'=>5])
            ->setLang('fr')
            ->setCreateAt(new \DateTimeImmutable());
        $about_en = new About();
        $about_en->setTitle('About Us')
            ->setSubTitleMessage('An inspiring subtitle message.')
            ->setBodyTitle('Our Story')
            ->setBodySubTitle('What drives us')
            ->setBenefits(['Quality', 'Innovation', 'Service'])
            ->setEndPageTitle('Conclusion')
            ->setEndPageText('Thank you for your interest in us.')
            ->setServicesStats([
                'satisfied clients' => 300,
                'projects' => 120,
                'complete project' => 50,
                'years' => 5
            ])
            ->setLang('en')
            ->setCreateAt(new \DateTimeImmutable());

        $manager->persist($about);
        $manager->persist($about_en);

        $manager->flush();
    }
}
