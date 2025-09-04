<template>
  <div class="w-full h-screen flex items-center justify-center text-sm">
    <form
      @submit.prevent="login"
      class="flex flex-col justify-between py-3 items-center shadow-indigo-700/20 shadow-2xl border border-neutral-700 rounded-md p-3 w-[30rem] h-[17rem]"
    >
      <div class="w-full flex flex-col gap-2">
        <span class="text-xl font-semibold py-4 flex items-center justify-center">Login</span>
        <div class="flex flex-col">
          <label
            for="email"
            class="text-xs text-gray-500 font-semibold"
          >Email:</label>
          <input
            type="email"
            id="email"
            v-model="email"
            placeholder="youremail@example.com"
            required
            class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-800 px-2 py-1"
            :class="{'border-red-500/50': email && !emailRegex()}"
          >
        </div>
        <div class="flex flex-col">
          <label
            for="password"
            class="text-xs text-gray-500 font-semibold"
          >Password:</label>
          <input
            type="password"
            id="password"
            v-model="password"
            required
            class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-800 px-2 py-1"
          >
        </div>
        <div class="text-xs flex gap-2 py-0.5">
          <span class="text-gray-500">Forgot your password?</span>
          <router-link
            to="/reset-password"
            class="text-blue-500"
          >
            Reset it here
          </router-link>
        </div>
      </div>

      <div class="flex gap-5">
        <router-link
          to="/register"
          class="hover:bg-blue-500/10 text-white rounded-xl px-4 py-1 transition-all duration-500 cursor-pointer"
        >
          Create Account
        </router-link>
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-8 py-1 transition-all duration-500 cursor-pointer"
        >
          Login
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';

import { useRequest } from '@/services/useRequest.js';
import { useRouter } from 'vue-router';

import { setToken } from '@/services/useAuth.js';

const router = useRouter();

const email = ref('');
const password = ref('');

const { dados, makeRequest } = useRequest("user", "post");

function emailRegex() {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email.value);
}

const login = async () => {
  try {
    await makeRequest({
      type: 'login',
      email: email.value,
      password: password.value
    });
    
    if (dados.value && dados.value.token) {
      setToken(dados.value.token);
      router.push('/home');
    }
  } catch (error) {
    console.error(error);
  }
};
</script>
