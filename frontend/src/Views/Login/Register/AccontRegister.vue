<template>
  <div class="w-full h-screen flex items-center justify-center text-sm">
    <form
      @submit.prevent="createNewUser"
      class="flex flex-col justify-between py-3 items-center shadow-indigo-700/20 shadow-2xl border border-neutral-700 rounded-md p-3 w-[30rem] h-[20rem]"
    >
      <div class="w-full flex flex-col gap-2">
        <span class="text-xl font-semibold py-4 flex items-center justify-center">Register</span>
        <div class="flex gap-2">
          <div class="flex flex-1 flex-col">
            <label
              for="first_name"
              class="text-xs text-gray-500 font-semibold"
            >First Name:</label>
            <input
              type="text"
              id="first_name"
              v-model="first_name"
              placeholder="Leon"
              required
              class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-800 px-2 py-1"
            >
          </div>
          <div class="flex flex-1 flex-col">
            <label
              for="last_name"
              class="text-xs text-gray-500 font-semibold"
            >Last Name:</label>
            <input
              type="text"
              id="last_name"
              v-model="last_name"
              placeholder="Kennedy"
              required
              class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-800 px-2 py-1"
            >
          </div>
        </div>
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
            :class="{ 'border-red-500/50': email && !emailRegex() }"
          >
        </div>
        <div class="relative flex flex-col">
          <label
            for="password"
            class="text-xs text-gray-500 font-semibold"
          >Password:</label>
          <input
            :type="seePassword ? 'text' : 'password'"
            id="password"
            v-model="password"
            placeholder="********"
            required
            class="border border-neutral-700 rounded-md focus:outline-1 focus:outline-blue-500 bg-neutral-800 px-2 py-1"
          >
          <Icon
            v-if="seePassword"
            @click="seePassword = false"
            icon="solar:eye-bold-duotone"
            class="h-5 w-5 cursor-pointer text-white absolute right-2 top-8 transform -translate-y-1/2"
          />
          <Icon
            v-else
            @click="seePassword = true"
            icon="solar:eye-closed-line-duotone"
            class="h-5 w-5 cursor-pointer text-white absolute right-2 top-8 transform -translate-y-1/2"
          />
        </div>
        <div class="text-xs flex gap-2 py-0.5">
          <span class="text-gray-500">You have an Account?</span>
          <router-link
            to="/login"
            class="text-blue-500"
          >
            Login here
          </router-link>
        </div>
      </div>

      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-20 py-1 transition-all duration-500 cursor-pointer"
      >
        Register
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";

import { useRequest } from "@/services/useRequest.js";
import { useAuth } from "../../../services/useAuth";

const { setToken } = useAuth();
const { dados, makeRequest } = useRequest("register", "post");

const seePassword = ref(false);

const first_name = ref("");
const last_name = ref("");
const email = ref("");
const password = ref("");

function emailRegex() {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email.value);
}

const createNewUser = async () => {
  if (!emailRegex()) return;
  await makeRequest({
    type: "register",
    first_name: first_name.value,
    last_name: last_name.value,
    email: email.value,
    password: password.value,
  });

  setToken(dados.value.token);
};
</script>
