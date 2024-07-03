<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;

class InscriptionController extends AbstractController
{

    private $passwordEncoder;
    private $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    #[Route('/inscription', name: 'scription')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/InscriptionController.php',
        ]);
    }

    #[Route('/api/user/inscription', name: 'app_inscription')]
    public function app_inscription(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Vérifiez si les données contiennent les champs nécessaires
        if (!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
            return new JsonResponse(['error' => 'Les champs username, email et password sont requis'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Créez un nouvel utilisateur avec les données reçues
        $user = new User();
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);

        // Hasher le mot de passe avant de l'enregistrer
        $hashedPassword = $this->passwordEncoder->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        // Enregistrez l'utilisateur dans la base de données (exemples de code)
         $entityManager = $this->em;
         $entityManager->persist($user);
         $entityManager->flush();

        // Répondez avec un message de succès
        return new JsonResponse([
            'message' => 'Utilisateur enregistré avec succès',
            'redirect_url' => '/' // URL vers laquelle vous souhaitez rediriger côté frontend (ex. accueil)
        ], JsonResponse::HTTP_CREATED);
    }
}
