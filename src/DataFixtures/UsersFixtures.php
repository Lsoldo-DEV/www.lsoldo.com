<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $userNames = [
            ['Joh', 'homawoojoseph@gmail.com'],
            ['John Doe', 'john.doe@example.com'],
            ['Jane Doe', 'jane.doe@example.com'],
            ['Alice Smith', 'alice.smith@example.com'],
            ['Bob Brown', 'bob.brown@example.com'],
            ['Charlie Johnson', 'charlie.johnson@example.com'],
            ['Diana Prince', 'diana.prince@example.com'],
            ['Eve Adams', 'eve.adams@example.com'],
            ['Frank White', 'frank.white@example.com'],
            ['Grace Hopper', 'grace.hopper@example.com'],
            ['Hank Moody', 'hank.moody@example.com'],
        ];

        foreach ($userNames as $key => [$fullName, $email]) {
            $user = new User();
            $user->setFullName($fullName);
            $user->setEmail($email);
            $user->setRoles(['ROLE_USER']);


            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($hashedPassword);

            $user->setVerified($key % 2 === 0);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
