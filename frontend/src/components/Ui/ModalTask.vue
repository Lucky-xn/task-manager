<template>
  <transition name="fade">
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <div
        ref="modal"
        class="relative w-[50rem] z-60 h-35 flex flex-col gap-6 items-center border border-neutral-700 bg-neutral-800 rounded-md p-4"
      >
        <span>New Task</span>
        <input
          @keypress.enter="newValue"
          type="text"
          v-model="text"
          class="w-full px-3 py-3 bg-transparent border border-neutral-600 rounded-md outline-none text-white"
          placeholder="Describe your task..."
        />
        <Icon
          icon="mdi:close"
          @click="emit('update:closeModal')"
          class="absolute h-6 w-6 top-2 right-2 text-white cursor-pointer hover:bg-neutral-600/20 rounded-full p-1"
        />
      </div>
    </div>
  </transition>
</template>

<script setup>
import { onClickOutside } from "@vueuse/core";
import { defineEmits, ref } from "vue";

const modal = ref(null);
const emit = defineEmits(["update:closeModal", "update:value"]);
const text = ref("");

const props = defineProps({
  showModal: {
    type: Boolean,
    required: true,
  },
});

onClickOutside(modal, () => emit("update:closeModal"));

const newValue = () => {
  if (!text.value) return;
  emit("update:value", text.value);
  console.log(text.value);
  emit("update:closeModal");
};
</script>

<style scoped>
.fade-enter-active {
  animation: fadeIn 0.5s;
}
.fade-leave-active {
  animation: fadeOut 0.5s;
}
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
@keyframes fadeOut {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}
</style>
