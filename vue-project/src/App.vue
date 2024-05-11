<script setup>
import HeaderView from './components/base/HeaderView.vue'
import FooterView from './components/base/FooterView.vue'

</script>

<template>
  <header>
   <HeaderView />
  </header>

  <main>
   <router-view></router-view>
  </main>

  <footer>
    <FooterView />
  </footer>

</template>

<style scoped>

</style>
