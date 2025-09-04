<template>
  <div ref="tooltip" tabindex="0" @keydown.esc="showMenu = false" class="relative">
    <div @click="toggleMenu" class="cursor-pointer">
      <slot name="item"></slot>
    </div>
    <transition name="fade" @after-leave="showMenu = false">
      <div
        v-show="showMenu"
        class="absolute right-0 mt-2 text-sm font-medium bg-neutral-800 border border-neutral-700 rounded-md shadow-lg py-0.5 z-50"
        :class="{
          'animate-fade-in': showMenu === true,
          'animate-fade-out': showMenu === false,
          [width]: true,
        }"
      >
        <slot></slot>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { onClickOutside } from "@vueuse/core";

const showMenu = ref(false);
const tooltip = ref(null);

onClickOutside(tooltip, () => (showMenu.value = false));

function toggleMenu() {
  showMenu.value = !showMenu.value;
}

defineProps({
  width: {
    type: String,
    default: "w-48",
  },
});
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.2s;
}
.animate-fade-out {
  animation: fadeOut 0.2s;
}
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
@keyframes fadeOut {
  from {
    opacity: 1;
    transform: translateY(0);
  }
  to {
    opacity: 0;
    transform: translateY(-10px);
  }
}
</style>
