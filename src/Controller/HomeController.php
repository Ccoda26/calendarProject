<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }
}


/*
<template>
<section class="myCalendarCustom">
    <h1>Calendar</h1>
    <ul>
        <li v-for="event in CalendarEvents" :key="event.id">
            {{event.id}} - {{event.title}}
        </li>
    </ul>
</section>
</template>

<script>
import Calendarservice from '@/services/Calendarservice.vue';

export default{
data() {
    return {
        CalendarEvents: [],
    };
},
mounted() {
    Calendarservice.getCalendarData()
    .then(data => {
        this.CalendarEvents = data;
    })
    .catch(error => {
       console.error('Erreur lors de la recuperation des donnees du calendrier :', error);
    });
},
};
</script>*/