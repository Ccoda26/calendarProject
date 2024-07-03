import './assets/main.css'


import { createApp } from 'vue';
import App from './App.vue';
import router from './router';  // Assurez-vous d'importer votre routeur si nécessaire
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faEye, faEyeSlash } from '@fortawesome/free-solid-svg-icons';

library.add(faEye, faEyeSlash);

const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon); // Enregistrez le composant global Font Awesome

app.use(router); // Assurez-vous d'utiliser votre routeur si nécessaire

app.mount('#app');

