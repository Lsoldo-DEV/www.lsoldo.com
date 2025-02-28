<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Description;
use App\Entity\Tag;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class PostFixtures extends Fixture
{    
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Créer un utilisateur admin
        $user = new User();
        $user->setEmail('admin22@example.com');
        $user->setFullName('Admin22 User');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password22'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        // Créer des tags
        $tags = [];
        $tagNames = ['laravel', 'PHPNative', 'Doctrine', 'Twig', 'Java', 'CSS', 'HTML', 'Web Development', 'Best Practices', 'Tutorial'];

        foreach ($tagNames as $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);
            $manager->persist($tag);
            $tags[] = $tag;
        }

        // Créer des posts avec des descriptions en anglais et en français
        $postsData = [
            [
                'slug' => 'introduction-to-symfony',
                'thumbnail' => 'symfony.jpg',
                'descriptions' => [
                    [
                        'lang' => 'en',
                        'title' => 'Introduction to Symfony',
                        'summary' => 'Learn the basics of Symfony, a powerful PHP framework.',
                        'content' => 'Symfony is a PHP framework that helps developers build robust and scalable web applications. It follows the MVC pattern and provides a set of reusable components.',
                        'tags' => ['Symfony', 'PHP', 'Web Development'],
                    ],
                    [
                        'lang' => 'fr',
                        'title' => 'Introduction à Symfony',
                        'summary' => 'Découvrez les bases de Symfony, un framework PHP puissant.',
                        'content' => 'Symfony est un framework PHP qui aide les développeurs à créer des applications web robustes et évolutives. Il suit le modèle MVC et fournit un ensemble de composants réutilisables.',
                        'tags' => ['laravel', 'PHPNative', 'Développement Web'],
                    ],
                ],

            ],
            [
                'slug' => 'mastering-doctrine-orm',
                'thumbnail' => 'doctrine.jpg',
                'descriptions' => [
                    [
                        'lang' => 'en',
                        'title' => 'Mastering Doctrine ORM',
                        'summary' => 'A comprehensive guide to using Doctrine ORM in Symfony.',
                        'content' => 'Doctrine ORM is a powerful object-relational mapper for PHP. It allows you to interact with your database using PHP objects instead of writing SQL queries.',
                        'tags' => ['Doctrine', 'PHPNative', 'ORM'],
                    ],
                    [
                        'lang' => 'fr',
                        'title' => 'Maîtriser Doctrine ORM',
                        'summary' => 'Un guide complet pour utiliser Doctrine ORM dans Symfony.',
                        'content' => 'Doctrine ORM est un puissant mapper objet-relationnel pour PHP. Il vous permet d\'interagir avec votre base de données en utilisant des objets PHP au lieu d\'écrire des requêtes SQL.',
                        'tags' => ['Doctrine', 'PHPNative', 'ORM'],
                    ],
                ],
            ],
            [
                'slug' => 'twig-templates-for-beginners',
                'thumbnail' => 'twig.jpg',
                'descriptions' => [
                    [
                        'lang' => 'en',
                        'title' => 'Twig Templates for Beginners',
                        'summary' => 'Learn how to use Twig, the templating engine for Symfony.',
                        'content' => 'Twig is a flexible and secure templating engine for PHP. It is widely used in Symfony projects to separate logic from presentation.',
                        'tags' => ['Twig', 'PHPNative', 'Web Development'],
                    ],
                    [
                        'lang' => 'fr',
                        'title' => 'Templates Twig pour Débutants',
                        'summary' => 'Apprenez à utiliser Twig, le moteur de templates pour Symfony.',
                        'content' => 'Twig est un moteur de templates flexible et sécurisé pour PHP. Il est largement utilisé dans les projets Symfony pour séparer la logique de la présentation.',
                        'tags' => ['Twig', 'PHPNative', 'Développement Web'],
                    ],
                ],
            ],
        ];

        foreach ($postsData as $postData) {
            $post = new Post();
            $post->setSlug($postData['slug']);
            $post->setAuthor($user);
            $post->setPublishedAt(new \DateTimeImmutable());
            $post->setLang('fr');

            foreach ($postData['descriptions'] as $descriptionData) {
                $description = new Description();
                $description->setTitle($descriptionData['title']);
                $description->setSummary($descriptionData['summary']);
                $description->setContent($descriptionData['content']);
                $description->setLang($descriptionData['lang']);
                $description->setPublishedAt(new \DateTimeImmutable());
                $description->setPost($post);

                // Associer les tags à la description
                foreach ($descriptionData['tags'] as $tagName) {
                    $tag = $this->findTagByName($tags, $tagName);
                    if ($tag) {
                        $description->addTag($tag);
                    }
                }

                $manager->persist($description);
            }

            $manager->persist($post);
        }

        $manager->flush();
    }

    /**
     * Trouve un tag par son nom dans la liste des tags.
     */
    private function findTagByName(array $tags, string $name): ?Tag
    {
        foreach ($tags as $tag) {
            if ($tag->getName() === $name) {
                return $tag;
            }
        }
        return null;
    }
}