<script>
import axios from 'axios';

const BASE_URL = 'http://localhost/customCalendar/public/';

export default {
    async inscription(userData) {
        try {
            const response = await axios.post('http://localhost/customCalendar/public/api/user/inscription', userData);
            if (response.data && response.data.redirect_url) {
                // Redirigez l'utilisateur vers l'URL spécifiée
                window.location.href = response.data.redirect_url;
            } else {
                console.error('La réponse du serveur ne contient pas de redirect_url');
                // Gérez le cas où la réponse ne contient pas l'URL de redirection
                // Peut-être afficher un message d'erreur ou rediriger vers une autre page par défaut
            }
        }catch(error) {
            throw error;
        }
    },
    async loginUser(userData){
        try {
            const response = await axios.post('http://localhost/customCalendar/public/api/user/connexion', userData);
            console.log('Réponse de connexion :', response.data);

            // Vérifiez si la réponse contient un message d'erreur
            if (response.data.error) {
                throw new Error(response.data.error);
            }

            // Redirection ou autre traitement après la connexion réussie
            window.location.href = response.data.redirect_url || '/';
        } catch (error) {
            console.error('Erreur lors de la connexion :', error.message);
            throw error; // Lancez à nouveau l'erreur pour la gestion dans le composant Vue.js parent
        }
    }
}
</script>