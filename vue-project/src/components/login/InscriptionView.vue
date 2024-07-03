<template>
  <div class="inscription-container">
    <h1 class="inscription-title">Inscription</h1>

    <form @submit.prevent="registerUser" class="inscription-form">
      <!-- Afficher les erreurs de validation ici -->
      <div v-if="errors.length > 0" class="alert alert-danger">
        <ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
      </div>

      <!-- Champ de formulaire pour le nom d'utilisateur -->
      <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" v-model="formData.username" class="form-control" required>
      </div>

      <!-- Champ de formulaire pour l'adresse e-mail -->
      <div class="form-group">
        <label for="email">Adresse e-mail</label>
        <input type="email" id="email" v-model="formData.email" class="form-control" required>
      </div>

      <!-- Champ de formulaire pour le mot de passe -->
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <div class="password-input">
          <input :type="showPassword ? 'text' : 'password'" id="password" v-model="formData.password" class="form-control" required>
          <span class="toggle-password" @click="togglePasswordVisibility">
            <font-awesome-icon :icon="showPassword ? 'eye-slash' : 'eye'" />
          </span>
        </div>
      </div>

      <!-- Bouton d'inscription -->
      <div class="form-group">
        <button type="submit" class="inscription-button">S'inscrire</button>
      </div>
    </form>

    <!-- Lien vers la page de connexion ou autre information -->
    <div class="additional-info">
      <p>Déjà inscrit ? <router-link to="/connexion">Connectez-vous ici</router-link></p>
      <!-- Autres informations supplémentaires -->
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faEye, faEyeSlash } from '@fortawesome/free-solid-svg-icons';
import LoginService from '@/services/LoginService.vue';
import bcrypt from 'bcryptjs'; 

export default {
  components: {
    FontAwesomeIcon, // Enregistrer le composant FontAwesomeIcon pour une utilisation dans le template
  },
  data() {
    return {
      formData: {
        username: '',
        email: '',
        password: ''
      },
      errors: [],
      showPassword: false // Initialisation de showPassword à false
    };
  },
  methods: {
    async registerUser() {
      try {
        const hashedPassword = await bcrypt.hash(this.formData.password, 10); // 10 est le coût du hachage
        const userData = {
          username: this.formData.username,
          email: this.formData.email,
          password: hashedPassword
        };
        console.log(userData)
        // Appel à LoginService pour envoyer les données du formulaire
        const response = await LoginService.inscription(userData);
        
        // Traitement de la réponse (par exemple, enregistrement de l'utilisateur dans le store Vuex)
        console.log('Réponse de connexion :', response);

        // Redirection vers une autre page ou traitement supplémentaire
        // this.$router.push('/dashboard'); // Exemple de redirection

      } catch (error) {
        // Gestion des erreurs
        console.error('Erreur de connexion :', error.message);
        this.loginError = error.message;
      }
    },
    togglePasswordVisibility() {
      // Méthode pour basculer la visibilité du mot de passe
      this.showPassword = !this.showPassword;
    }
  }
};
</script>

<style scoped>
/* Styles spécifiques au composant d'inscription */
.inscription-container {
  max-width: 600px;
  margin: 50px auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.inscription-title {
  text-align: center;
  color: #333;
  font-size: 24px;
  margin-bottom: 20px;
}

.inscription-form {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  color: #555;
}

.password-input {
  position: relative;
}

.password-input input {
  width: calc(100% - 30px);
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.toggle-password {
  position: absolute;
  top: 50%;
  right: 5px;
  transform: translateY(-50%);
  cursor: pointer;
}

/* Styles pour l'icône de Font Awesome */
.toggle-password .svg-inline--fa {
  font-size: 18px;
  color: #24527a;
}

.inscription-button {
  background-color: #24527a;
  color: #fff;
  border: none;
  padding: 12px 20px;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.inscription-button:hover {
  background-color: #1c4362;
}

.additional-info {
  margin-top: 20px;
  text-align: center;
  color: #666;
}

.additional-info a {
  color: #24527a;
  text-decoration: none;
}

.additional-info a:hover {
  text-decoration: underline;
}
</style>
