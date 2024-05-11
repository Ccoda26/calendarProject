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
        weekends: false, // initial value
        locale: frLocale,
        eventColor: '#a7bcb9',
        eventTextColor: '#e0ebeb',
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
                title : arg.event.title,
                startDate: moment(eventStart).format('YYYY-MM-DD HH:mm:ss'),
                endDate: moment(eventEnd).format('YYYY-MM-DD HH:mm:ss')
            };

            try {
                Calendarservice.updateEvent(eventData);
            } catch (error) {
                console.error("Erreur lors de la modification", error);
            }
        }
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
        <FullCalendar :options="calendarOptions" />
    </div>
</template>







