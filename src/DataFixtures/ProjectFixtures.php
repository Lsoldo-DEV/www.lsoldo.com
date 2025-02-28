<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tagNames = ['Symfony', 'React', 'JavaScript', 'PHP', 'Node.js'];
        $tags = [];

        foreach ($tagNames as $name) {
            $tag = new Tag();
            $tag->setName($name);
            $manager->persist($tag);
            $tags[] = $tag;
        }

        // Liste de projets (FR & EN)
        $projectsData = [
            [
                'title' => 'Plateforme de gestion des étudiants',
                'brief' => 'Une application permettant de gérer les étudiants et leurs notes.',
                'full' => 'Cette plateforme permet aux enseignants de suivre les progrès des étudiants, gérer les cours et attribuer des notes en temps réel.',
                'technologies' => ['PHP', 'Symfony', 'MySQL'],
                'link' => 'https://gestion-etudiants.com',
                'lang' => 'fr',
                'client' => 'Université ParisTech',
            ],
            [
                'title' => 'E-commerce Website',
                'brief' => 'An online store with secure payments and customer management.',
                'full' => 'This project includes a shopping cart, payment gateway integration, and customer review system for an optimal shopping experience.',
                'technologies' => ['React', 'Node.js', 'MongoDB'],
                'link' => 'https://shop-online.com',
                'lang' => 'en',
                'client' => 'TechStore Inc.',
            ],
            [
                'title' => 'Système de réservation de salles',
                'brief' => 'Une solution en ligne pour réserver des salles de réunion.',
                'full' => 'L’application permet aux entreprises de gérer leurs espaces de réunion, d’attribuer des créneaux horaires et d’automatiser les rappels.',
                'technologies' => ['Laravel', 'Vue.js', 'PostgreSQL'],
                'link' => 'https://reservation-salles.com',
                'lang' => 'fr',
                'client' => 'Espace CoWork',
            ],
            [
                'title' => 'Healthcare Appointment System',
                'brief' => 'A platform for booking doctor appointments online.',
                'full' => 'Patients can book, reschedule, and manage their medical appointments with automated reminders and a secure patient history system.',
                'technologies' => ['Django', 'React', 'PostgreSQL'],
                'link' => 'https://healthcare-booking.com',
                'lang' => 'en',
                'client' => 'MediCare Solutions',
            ],
        ];

        // Création des projets
        foreach ($projectsData as $data) {
            $project = new Project();
            $project->setTitle($data['title']);
            $project->setBriefDescription($data['brief']);
            $project->setFullDescription($data['full']);
            $project->setTechnologies($data['technologies']);
            $project->setProjectLink($data['link']);
            $project->setCreatedAt(new \DateTimeImmutable());
            $project->setUpdatedAt(new \DateTimeImmutable());
            $project->setLang($data['lang']);
            $project->setClientName($data['client']);

            // Ajout de tags aléatoires (1 à 3 par projet)
            shuffle($tags);
            foreach (array_slice($tags, 0, rand(1, 3)) as $tag) {
                $project->addTag($tag);
            }

            $manager->persist($project);
        }

        $manager->flush();
    }
}


