<?php

namespace App\DataFixtures;

use App\Entity\Service;
use App\Entity\ServiceDescription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $slugger = new AsciiSlugger();
        $services = [
            'Web Development',
            'Mobile Development',
            'UI/UX Design',
            'Cloud Services',
        ];

        $descriptions = [
            'Web Development' => [
                [
                    'lang' => 'en',
                    'title' => 'Build Amazing Websites',
                    'summary' => 'Creating modern and responsive websites.',
                    'content' => 'Our web development team builds scalable and secure websites tailored to your needs.',
                ],
                [
                    'lang' => 'fr',
                    'title' => 'Créez des sites incroyables',
                    'summary' => 'Création de sites modernes et réactifs.',
                    'content' => 'Notre équipe de développement web conçoit des sites web sécurisés et évolutifs.',
                ],
            ],
            'Mobile Development' => [
                [
                    'lang' => 'en',
                    'title' => 'Craft Stunning Apps',
                    'summary' => 'Developing mobile apps for iOS and Android.',
                    'content' => 'Our mobile development expertise ensures your app performs flawlessly across platforms.',
                ],
                [
                    'lang' => 'fr',
                    'title' => 'Creation ',
                    'summary' => 'Developing mobile apps for iOS and Android.',
                    'content' => 'Our mobile development expertise ensures your app performs flawlessly across platforms.',
                ],
            ],
            'UI/UX Design' => [
                [
                    'lang' => 'en',
                    'title' => 'Exceptional User Experience',
                    'summary' => 'Designing interfaces that users love.',
                    'content' => 'We focus on creating intuitive designs that enhance user engagement.',
                ],
                [
                    'lang' => 'fr',
                    'title' => 'Exceptionel User Experience',
                    'summary' => 'Designing interfaces that users love.',
                    'content' => 'We focus on creating intuitive designs that enhance user engagement.',
                ],
            ],
            'Cloud Services' => [
                [
                    'lang' => 'en',
                    'title' => 'Scalable Cloud Solutions',
                    'summary' => 'Providing reliable cloud infrastructure.',
                    'content' => 'Leverage our cloud expertise to ensure your business is future-ready.',
                ],
                [
                    'lang' => 'fr',
                    'title' => 'Scalable Cloud Solutions fr',
                    'summary' => 'Providing reliable cloud infrastructure.',
                    'content' => 'Leverage our cloud expertise to ensure your business is future-ready.',
                ],
            ],
        ];

        foreach ($services as $serviceName) {
            $service = new Service();
            $service->setName($serviceName);
            $service->setSlug($slugger->slug($serviceName)->lower());

            if (isset($descriptions[$serviceName])) {
                foreach ($descriptions[$serviceName] as $descData) {
                    $description = new ServiceDescription();
                    $description->setLang($descData['lang']);
                    $description->setTitle($descData['title']);
                    $description->setSummary($descData['summary']);
                    $description->setContent($descData['content']);
                    $description->setPublishedAt(new \DateTimeImmutable());
                    $description->setService($service);
                    $manager->persist($description);
                }
            }

            $manager->persist($service);
        }

        $manager->flush();
    }
}
