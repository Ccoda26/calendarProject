<script>
    import EventService from '@/services/EventService.vue';
    export default {
        data() {
            return {
            eventName: '',
            eventStart: '',
            eventEnd: ''
            };
        },
        methods: {
            async submitEvent() {
            try {
                const eventData = {
                eventName: this.eventName,
                eventStart: this.eventStart,
                eventEnd: this.eventEnd
                };
                // Appel à EventService pour envoyer les données du formulaire
                await EventService.addEvent(eventData);
                // Réinitialiser les champs du formulaire après soumission
                this.eventName = '';
                this.eventStart = '';
                this.eventEnd = '';
                // Redirection ou autres actions après avoir ajouté l'événement avec succès
                // Exemple de redirection vers une autre page :
                 this.$router.push('/calendar');
            } catch (error) {
                console.error('Erreur lors de l\'ajout de l\'événement :', error);
                // Gérer les erreurs de manière appropriée
            }
            }
        }
        };
  </script>
  
<template>
    <div class="container">
      <h1 class="my-4">Ajouter un événement</h1>
      <div class="card">
        <div class="card-body">
          <form @submit.prevent="submitEvent">
            <div class="form-group">
              <label for="eventName">Nom de l'événement :</label>
              <input type="text" id="eventName" class="form-control" v-model="eventName">
            </div>
            <div class="form-group">
              <label for="eventStart">Date de début :</label>
              <input type="datetime-local" id="eventStart" class="form-control" v-model="eventStart">
            </div>
            <div class="form-group">
              <label for="eventEnd">Date de fin :</label>
              <input type="datetime-local" id="eventEnd" class="form-control" v-model="eventEnd">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter l'événement</button>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  