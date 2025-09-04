<template>
  <BaseTooltip>
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
  </BaseTooltip>
</template>

<script setup>
import BaseTooltip from "@/components/Ui/BaseTooltip.vue";
import { useAuth } from "@/services/useAuth";

const { logout } = useAuth();
</script>