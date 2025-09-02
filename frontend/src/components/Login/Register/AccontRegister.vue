<template>
  <div class="w-full h-screen flex items-center justify-center text-sm">
    <form
      class="flex flex-col justify-between py-3 items-center shadow-2xl border border-neutral-700 rounded-md p-3 w-[30rem] h-[18rem]"
    >
      <div class="w-full flex flex-col gap-2">
        <span class="text-xl font-semibold py-4 flex items-center justify-center"
          >Register</span
        >
        <div class="flex gap-2">
          <div class="flex flex-1 flex-col">
            <label for="first_name" class="text-xs text-gray-500 font-semibold"
              >First Name:</label
            >
            <input
              type="text"
              id="first_name"
              v-model="first_name"
              placeholder="Leon"
              required
              class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-700 px-2 py-1"
            />
          </div>
          <div class="flex flex-1 flex-col">
            <label for="last_name" class="text-xs text-gray-500 font-semibold"
              >Last Name:</label
            >
            <input
              type="text"
              id="last_name"
              v-model="last_name"
              placeholder="Kennedy"
              required
              class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-700 px-2 py-1"
            />
          </div>
        </div>
        <div class="flex flex-col">
          <label for="email" class="text-xs text-gray-500 font-semibold">Email:</label>
          <input
            type="email"
            id="email"
            v-model="email"
            placeholder="youremail@example.com"
            required
            class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-700 px-2 py-1"
            :class="{ 'border-red-500/50': email && !emailRegex() }"
          />
        </div>
        <div class="flex flex-col">
          <label for="password" class="text-xs text-gray-500 font-semibold"
            >Password:</label
          >
          <input
            type="password"
            id="password"
            v-model="password"
            placeholder="********"
            required
            class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-700 px-2 py-1"
          />
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
import { ref } from "vue";

const first_name = ref('');
const last_name = ref('');
const email = ref('');
const password = ref('');

function emailRegex() {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email.value);
}
</script>
