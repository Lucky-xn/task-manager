<template>
  <div>
    <NavBar v-if="url !== '/Login'" />
    <router-view />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';

import NavBar from "./components/NavBar.vue";

const route = useRoute();

const url = ref(route.fullPath);


</script>
