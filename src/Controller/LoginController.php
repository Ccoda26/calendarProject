<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\User;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LoginController.php',
        ]);
    }

    #[Route('/api/user/connexion', name: 'app_login')]
    public function app_login(Request $request, UserPasswordEncoderInterface $passwordEncoder): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        dd($data);
      
        // Répondre avec un message de succès et une URL de redirection
        return new JsonResponse([
            'message' => 'Utilisateur connecté avec succès',
            'redirect_url' => '/' // URL vers laquelle vous souhaitez rediriger côté frontend (par exemple, accueil)
        ], JsonResponse::HTTP_CREATED);
    }
}
