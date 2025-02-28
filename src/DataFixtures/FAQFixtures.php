<?php

namespace App\DataFixtures;

use App\Entity\FAQ;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FAQFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faqsData = [
            [
                'question_en' => 'Do you offer both on-site and remote IT support?',
                'answer_en' => 'Yes, we offer both on-site and remote IT support to meet your needs.',
                'question_fr' => 'Proposez-vous un support informatique sur site et à distance ?',
                'answer_fr' => 'Oui, nous proposons un support informatique à la fois sur site et à distance pour répondre à vos besoins.',
            ],
            [
                'question_en' => 'What is Techida?',
                'answer_en' => 'Techida is an innovative technology solutions provider.',
                'question_fr' => 'Qu\'est-ce que Techida ?',
                'answer_fr' => 'Techida est un fournisseur innovant de solutions technologiques.',
            ],
            [
                'question_en' => 'Is there any update in the future?',
                'answer_en' => 'Yes, we continuously improve our services and updates are planned.',
                'question_fr' => 'Y aura-t-il des mises à jour à l\'avenir ?',
                'answer_fr' => 'Oui, nous améliorons continuellement nos services et des mises à jour sont prévues.',
            ],
            [
                'question_en' => 'How much for the service?',
                'answer_en' => 'The pricing depends on the specific service required. Contact us for a quote.',
                'question_fr' => 'Combien coûte le service ?',
                'answer_fr' => 'Le prix dépend du service spécifique requis. Contactez-nous pour un devis.',
            ],
        ];

        foreach ($faqsData as $faqData) {
            $faqEn = new FAQ();
            $faqEn->setQuestion($faqData['question_en']);
            $faqEn->setAnswer($faqData['answer_en']);
            $faqEn->setLang('en');
            $manager->persist($faqEn);

            $faqFr = new FAQ();
            $faqFr->setQuestion($faqData['question_fr']);
            $faqFr->setAnswer($faqData['answer_fr']);
            $faqFr->setLang('fr');
            $manager->persist($faqFr);
        }

        $manager->flush();
    }
}


