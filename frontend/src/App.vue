<template>
  <div>
    <NavBar v-if="url !== 'system'" />
    <router-view />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';

import { useRequest } from './services/useRequest';

import NavBar from "./components/NavBar.vue";

const route = useRoute();

const { dados, makeRequest, loading } = useRequest('teste', 'POST'); 

const url = computed(() => route.meta.type);


onMounted(async () => {
  await makeRequest({
    teste: 'teste'
  });
})

</script>
