<template>
  <UiTooltip>
    <template #item>
      <div
        class="flex items-center justify-center bg-neutral-500 w-7 h-7 rounded-full cursor-pointer transition-all"
      ></div>
    </template>
    <div class="flex flex-col gap-1 p-1">
      <div
        class="flex gap-1 items-center cursor-pointer hover:bg-neutral-700 rounded-md px-2 py-1"
      >
        <Icon icon="mdi:account" />
        <span>Profile</span>
      </div>
      <div
        class="flex gap-1 items-center cursor-pointer hover:bg-neutral-700 rounded-md px-2 py-1"
      >
        <Icon icon="mdi:settings" />
        <span>Settings</span>
      </div>
      <div
        @click="logout"
        class="flex gap-1 items-center text-red-600 cursor-pointer hover:bg-neutral-700 rounded-md px-2 py-1"
      >
        <Icon icon="mdi:logout" />
        <span>Logout</span>
      </div>
    </div>
  </UiTooltip>
</template>

<script setup>
import UiTooltip from "@/components/ui/UiTooltip.vue";

import { removeToken } from "../../services/Auth";

function logout() {
  removeToken();
  window.location.reload();
}
</script>
