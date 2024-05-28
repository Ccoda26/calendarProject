<script>
import FullCalendar from '@fullcalendar/vue3'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import frLocale from '@fullcalendar/core/locales/fr-ca'
import Calendarservice from '@/services/CalendarService.vue';
import moment from 'moment';

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
    data() {
    return {
      calendarOptions: {
        plugins: [ timeGridPlugin, interactionPlugin ],
        initialView: 'timeGridWeek',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridDay,timeGridWeek',
        },
        events: [],
        eventDisplay: 'block',
        editable: true,
        slotMinTime: '08:00:00',
        slotMaxTime: '20:00:00',
        eventClick: this.handleEventClick,
        eventDrop: this.handleEventDrop,
        eventResize: this.handleEventDrop,
        weekends: false,
        locale: frLocale,
        eventColor: '#FFFAFA',
        eventTextColor: '#536878',
        height: 'auto',
        handleWindowResize: true,
        dayMaxEventRows: true,
      }
    }
  },
  methods: {
    toggleWeekends: function() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // toggle the boolean!
    },
    async fetchEvents () {
        try {
            const events = await Calendarservice.getCalendarData();
            this.calendarOptions.events = events;
        } catch (error) {
            console.error('une erreur est survenue', error)
        }
    },
    handleEventClick: function (arg) {
        // gerer le click d'un evenement ouvrir une boite de dialogue d'editions
        const eventTitle = prompt(' Modifier le tite de l\'evenement: ', arg.event.title);
        const eventStart = arg.event.start;
        const eventEnd = arg.event.end;
        
        if (eventTitle) {
            arg.event.setProp('title', eventTitle);
            arg.event.setProp('start', eventStart);
            arg.event.setProp('end', eventEnd);

            const eventData = {
                id:  arg.event.id,
                title: arg.event.title,
                start: moment(eventStart).format('YYYY-MM-DD HH:mm:ss'),
                end: moment(eventEnd).format('YYYY-MM-DD HH:mm:ss')
            };

            try {
              console.log(eventData)
                Calendarservice.updateEvent(eventData);
            } catch (error) {
                console.error("Erreur lors de la modification", error);
            }
        }
    },
    handleEventDrop(info) {
      console.log(info)
        const eventId =  info.event.id;
        const eventTitle =  info.event.title;
        const newStart = info.event.start; // Nouvelle date de début
        const newEnd =  info.event.end;
      // Gérer le déplacement de l'événement
      const updatedEvent = {
        id: eventId,
        title: eventTitle,
        start: moment(newStart).format('YYYY-MM-DD HH:mm:ss'), // Utilisez toISOString() pour obtenir le format ISO 8601
        end: moment(newEnd).format('YYYY-MM-DD HH:mm:ss'),
      };

      // Envoyer les informations mises à jour au backend pour sauvegarde
      Calendarservice.updateEvent(updatedEvent);
    }
  },
  created() {
    this.fetchEvents()
  }
}
</script>
<template>
  
    <div>
        <button @click="toggleWeekends">Avec les Weekends</button>
        <router-link to="/addEvent" class="btn">ajouter un Event</router-link>
        <FullCalendar :options="calendarOptions" />
    </div>
</template>







