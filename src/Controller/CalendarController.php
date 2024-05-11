<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/api/calendar', name: 'app_calendar')]
    public function getCalendarData(): JsonResponse
    {
        $calendarData = [
            ['title' => 'Rdv Pascal', 'start' => '2024-05-08 16:00', 'end' => '2024-05-08 16:00'],
            ['title' => 'Rdv Charlie 16h30', 'start' => '2024-05-07 08:00', 'end' => '2024-05-07 11:30'],  
            ['title' => 'Rdv coiffeur', 'start' => '2024-05-09 13:00', 'end' => '2024-05-09 14:30'],
            ['title' => 'Medecins', 'start' => '2024-05-10 08:00', 'end' => '2024-05-10 09:00'],
        ];

        return new JsonResponse($calendarData);
    }

    #[Route('/api/calendar/update', name: 'update_event_calendar')]
    public function updateCalendarData(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        //gerer les donnees pour les save en DB 
        //$data;

        return new JsonResponse(['message' => 'les donnees sont bien arrivees']);
    }
}
