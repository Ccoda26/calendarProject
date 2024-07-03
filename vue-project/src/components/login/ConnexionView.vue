<template>
  <div class="connexion-container">
    <h1 class="connexion-title">Connexion</h1>

    <form @submit.prevent="loginUser" class="connexion-form">
      <!-- Affichez les erreurs de connexion ici -->
      <div v-if="errors.length > 0" class="alert alert-danger">
        <ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
      </div>

      <!-- Champs de formulaire -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" v-model="formData.email" required>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <div class="password-input">
          <input :type="showPassword ? 'text' : 'password'" id="password" v-model="formData.password" class="form-control" required>
          <span class="toggle-password" @click="togglePasswordVisibility">
            <font-awesome-icon :icon="showPassword ? 'eye-slash' : 'eye'" />
          </span>
        </div>
      </div>

      <!-- Bouton de connexion -->
      <div class="form-group">
        <button type="submit" class="connexion-button">Se connecter</button>
      </div>
    </form>

    <!-- Lien vers la page d'inscription ou autre information -->
    <div class="additional-info">
      <p>Pas encore inscrit ? <router-link to="/inscription">Inscrivez-vous ici</router-link></p>
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
        email: '',
        password: ''
      },
      errors: [],
      showPassword: false
    };
  },
  methods: {
    async loginUser() {
      try {
        const hashedPassword = await bcrypt.hash(this.formData.password, 10);
        const userData = {
          email: this.formData.email,
          password: hashedPassword
        };
        console.log(userData);
        const response = await LoginService.loginUser(userData);
        
        console.log('Réponse de connexion :', response);
        
        // Exemple de redirection après la connexion réussie
        // this.$router.push('/dashboard');
        
      } catch (error) {
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
/* Styles spécifiques au composant de connexion */
.connexion-container {
  max-width: 600px;
  margin: 50px auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.connexion-title {
  text-align: center;
  color: #333;
  font-size: 24px;
  margin-bottom: 20px;
}

.connexion-form {
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

.form-group input {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
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

.connexion-button {
  background-color: #24527a;
  color: #fff;
  border: none;
  padding: 12px 20px;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.connexion-button:hover {
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
