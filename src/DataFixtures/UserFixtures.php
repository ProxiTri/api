<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail($_ENV['ADMIN_EMAIL']);
        $hashedPassword = $this->userPasswordHasherInterface->hashPassword(
            $user,
            $_ENV['ADMIN_PASSWORD']
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($user);
        $manager->flush();

        $user2 = new User();
        $user2->setEmail($_ENV['ADMIN_EMAIL']. 'test');
        $hashedPassword = $this->userPasswordHasherInterface->hashPassword(
            $user2,
            $_ENV['ADMIN_PASSWORD'].'test'
        );
        $user2->setPassword($hashedPassword);
        $user2->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user2->setCreatedAt(new \DateTimeImmutable());
        $user2->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($user2);
        $manager->flush();
    }
}