<script>
import axios from 'axios';

const BASE_URL = 'http://localhost/customCalendar/public/';

export default {
    async getCalendarData() {
        return axios.get('http://localhost/customCalendar/public/api/calendar')
        .then(response => response.data)
        .catch(error => {
            console.error('Erreur lors de la recuperation du calendrier :', error);
            throw error;
        });
    },
    async updateEvent(eventData) {
        try {
            console.log(eventData)
            await axios.post('http://localhost/customCalendar/public/api/calendar/update',eventData)
        }catch(error) {
            throw error;
        }
    }
};

</script>