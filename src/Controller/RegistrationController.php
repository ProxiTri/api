<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\AppAuthenticator;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    private UserRepository $userRepository;
    private ValidatorInterface $validator;
    private ManagerRegistry $doctrine;

    public function __construct(ValidatorInterface $validator, UserRepository $userRepository, ManagerRegistry $doctrine)
    {
        $this->validator = $validator;
        $this->userRepository = $userRepository;
        $this->doctrine = $doctrine;
    }

    #[Route('/api/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
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

        if (!empty($data['lastname'])) {
            $user->setName($data['lastname']);
        }
        if (!empty($data['name'])) {
            $user->setFirstname($data['name']);
        }

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password']
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $errors = $this->validator->validate($user);
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                return new JsonResponse([
                    'statusCode' => 400,
                    'message' => $error->getMessage()
                ], 400);
            }
        }

        if ($this->userRepository->findOneBy(['email' => $data['email']])) {
            return new JsonResponse([
                'statusCode' => 400,
                'message' => 'Cet email est d??j?? utilis??'
            ], 400);
        }

        $em = $this->doctrine->getManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse([
            'statusCode' => 201,
            'message' => "Compte cr??e avec succ??s ! ID du compte : " . $user->getUserIdentifier()
        ], 201);
    }
}
