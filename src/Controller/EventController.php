<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Event;

class EventController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/event', name: 'app_event')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EventController.php',
        ]);
    }
    
    #[Route('/api/event/add', name: 'add_event')]
    public function addEvent(Request $request, EntityManagerInterface $em) : JsonResponse
    {
        $em = $this->entityManager;
        $data = json_decode($request->getContent(), true);

        $event = new Event();
        $event->setEventTitle($data['eventName']);
        $event->setEventStart(new \DateTime($data['eventStart']));
        $event->setEventEnd(new \DateTime($data['eventEnd']));

        // Persister l'événement dans la base de données
        $em->persist($event);
        $em->flush();

        return new JsonResponse(['message' => 'les donnees sont bien arrivees']);
    }
}
