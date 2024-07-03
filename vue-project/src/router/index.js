import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Calendar from '../views/calendar/CalendarView.vue'
import addEvent from '../components/addEvent/addEvent.vue'
import Inscription from '@/components/login/InscriptionView.vue'
import Connexion from '@/components/login/ConnexionView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/calendar',
      name: 'calendar',
      component: Calendar
    },
    {
      path: '/addEvent',
      name: 'addEvent',
      component: addEvent
    },
    {
      path: '/inscription',
      name: 'inscription',
      component: Inscription
    },
    {
      path: '/connexion',
      name: 'connexion',
      component: Connexion
    },
  ]
})

export default router
