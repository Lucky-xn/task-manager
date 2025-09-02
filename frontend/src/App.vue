<template>
  <div>
    <NavBar v-if="url !== 'system'" />
    <router-view />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';

import NavBar from "./components/NavBar.vue";

const route = useRoute();


const url = computed(() => route.meta.type);
</script>
