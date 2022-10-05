<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Uid\Uuid;

class RegistrationController extends AbstractController
{
    #[Route('/api/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = new User();
//        dd($request);
        $user->setEmail($request->get('email'));
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $request->get('password')
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $em = $doctrine->getManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse($user);
    }
}
