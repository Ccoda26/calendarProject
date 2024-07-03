<template>
    <div class="home">
        <h1>Bienvenue sur notre site de prise de rendez-vous</h1>
        <p>Planifiez facilement vos rendez-vous en ligne</p>

        <!-- Bloc des sociétés les plus populaires -->
        <div class="popular-companies">
            <div class="company">
                <h3>AlphaTech Solutions</h3>
                <p>AlphaTech Solutions offre des solutions technologiques innovantes pour les entreprises de toutes tailles, en se spécialisant dans le développement de logiciels sur mesure et la consultation en technologie de l'information. Contactez-nous dès aujourd'hui pour découvrir comment nous pouvons optimiser votre entreprise.</p>
                <p>Téléphone : +1 (555) 123-4567</p>
                <router-link to="/calendar" class="btn">Voir les rendez-vous</router-link>
            </div>
            <div class="company">
                <h3>BrightStar Consulting</h3>
                <p>BrightStar Consulting fournit des services de consultation en gestion d'entreprise pour aider les organisations à atteindre leurs objectifs stratégiques. De la planification stratégique à la mise en œuvre, notre équipe expérimentée est là pour vous guider à chaque étape du processus. Appelez-nous dès maintenant pour planifier une consultation gratuite.</p>
                <p>Téléphone : +1 (555) 987-6543</p>
                <router-link to="/calendar" class="btn">Voir les rendez-vous</router-link>
            </div>
            <div class="company">
                <h3>Quantum Innovations</h3>
                <p>Quantum Innovations est à la pointe de l'innovation, offrant des solutions créatives et sur mesure pour répondre aux besoins changeants de nos clients. Notre équipe d'experts est déterminée à apporter des solutions révolutionnaires à vos défis commerciaux les plus pressants. Contactez-nous dès aujourd'hui pour commencer à façonner l'avenir de votre entreprise.</p>
                <p>Téléphone : +1 (555) 234-5678</p>
                <router-link to="/calendar" class="btn">Voir les rendez-vous</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Home',
}
</script>

<style scoped>
.home {
    text-align: center;
    margin-top: 50px;
}
.btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 20px 5px;
    background-color: #f0f0f0;
    color: #333;
    text-decoration: none;
    border-radius: 25px;
    transition: background-color 0.3s ease;
    border: 2px solid #ccc;
    font-weight: bold;
}
.btn:hover {
    background-color: #e0e0e0;
}
/* Styles pour les sociétés populaires */
.popular-companies {
    display: flex;
    justify-content: space-around; /* Aligne les sociétés avec un espace égal entre elles */
    margin-top: 50px;
}

.company {
    width: 30%;
    padding: 50px;
    border:#f0f0f0 solid 1px;
    border-radius: 20px;
    text-align: center;
}

.company h3 {
    margin-top: 10px;
    font-weight: bold;
    font-size: 18px;
}
</style>
