<template>
  <nav
    class="flex justify-between items-center border-b border-neutral-700 shadow-2xl w-full py-4 px-5 bg-neutral-900"
  >
    <span
      class="font-semibold text-lg transition-all duration-300 hover:text-green-400 cursor-pointer select-none"
    >
      Gerenciador de Tarefas
    </span>
    <UserTooltip />
  </nav>
</template>

<script setup>
import UserTooltip from './System/UserTooltip.vue';

</script>
