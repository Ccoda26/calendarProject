<script>
import axios from 'axios';

const BASE_URL = 'http://localhost/customCalendar/public/';

export default {
    async addEvent(eventData) {
        try {
            await axios.post('http://localhost/customCalendar/public/api/event/add',eventData)
        }catch(error) {
            throw error;
        }
    }
}
</script>