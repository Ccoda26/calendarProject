<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Event;

class CalendarController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/calendar', name: 'app_calendar')]
    public function getCalendarData(): JsonResponse
    {
       // $calendarData = [
       //     ['id' => 1, 'title' => 'Rdv Pascal', 'start' => '2024-05-28 16:00', 'end' => '2024-05-28 16:00'],
       //     ['id' => 2, 'title' => 'Rdv Charlie 16h30', 'start' => '2024-05-27 08:00', 'end' => '2024-05-27 11:30'],  
       //     ['id' => 3, 'title' => 'Rdv coiffeur', 'start' => '2024-05-28 13:00', 'end' => '2024-05-28 14:30'],
        //    ['id' => 4, 'title' => 'Medecins', 'start' => '2024-05-30 08:00', 'end' => '2024-05-30 09:00'],
        //];

        $em = $this->entityManager;
        $events = $em->getRepository(Event::class)->findAll();
        $calendarData = [];

        // Parcourir chaque événement récupéré
        foreach ($events as $event) {
            // Ajouter les données formatées à $calendarData
            $calendarData[] = [
                'id' => $event->getId(),
                'title' => $event->getEventTitle(),
                'start' => $event->getEventStart()->format('Y-m-d H:i'),
                'end' => $event->getEventEnd()->format('Y-m-d H:i'),
            ];
        }

        return new JsonResponse($calendarData);
    }

    #[Route('/api/calendar/update', name: 'update_event_calendar')]
    public function updateCalendarData(Request $request)
    {
        $em = $this->entityManager;

        $data = json_decode($request->getContent(), true);
        $event = $em->getRepository(Event::class)->find($data['id']);

        if ($event) { 
            $event->setEventTitle($data['title']);
            $event->setEventStart(new \DateTime($data['start']));
            $event->setEventEnd(new \DateTime($data['end']));

            // Persister l'événement dans la base de données
            $em->persist($event);
            $em->flush();

            return new JsonResponse('Événement mis à jour avec succès');
        } else {
            // Si l'événement n'existe pas, répondre avec un code de statut d'erreur
            return new JsonResponse('Événement non trouvé');
        }
    }
}
