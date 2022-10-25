<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
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
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/api/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher, ValidatorInterface $validator, UserRepository $userRepository): JsonResponse
    {
        $user = new User();
        $data = json_decode($request->getContent(), true);
        if (empty($data['email']) || empty($data['password'])) {
            return new JsonResponse([
                'statusCode' => 400,
                'message' => 'Les champs email et password sont obligatoires'
            ], 400);
        }

        $user->setEmail($data['email']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password']
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        if ($userRepository->findOneBy(['email' => $data['email']])) {
            return new JsonResponse([
                'statusCode' => 400,
                'message' => 'Cet email est déjà utilisé'
            ], 400);
        }
        $em = $doctrine->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse("Compte crée avec succès ! ID du compte : " . $user->getUserIdentifier(), 201);
    }
}
