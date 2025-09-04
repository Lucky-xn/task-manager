<template>
  <div
    class="relative w-screen h-[100vh] max-h-[100vh] mt-10 flex flex-col items-center overflow-hidden"
  >
    <div class="flex text-white justify-center items-center w-full">
      <span class="flex items-center justify-center gap-2 flex-col font-semibold">
        <span class="text-xl">Seja bem Vindo!</span>
        <span>{{ user?.first_name }} {{ user?.last_name }}</span>
      </span>
    </div>
    <SimpleCard class="w-full max-w-[50%] mt-10">
      <div
        class="w-full flex items-center justify-end border-b text-sm border-neutral-700 pb-2 mb-2"
      >
        <span
          class="bg-blue-600 transition-all duration-300 rounded-md px-4 py-1 cursor-pointer"
          @click="modalNewTask = true"
          >Adicionar Tarefa</span
        >
      </div>
      <DataTable :columns="columns" :data="''">
        <template #row="{ item }">
          <td v-for="(value, key) in item" :key="key">{{ value }}</td>
        </template>
      </DataTable>
    </SimpleCard>
  </div>
  <ModalTask :showModal="modalNewTask" @update:closeModal="modalNewTask = false" />
</template>

<script setup>
import { useAuth } from "../services/useAuth";
import { onMounted, ref } from "vue";
import { useRequest } from '@/services/useRequest';

import DataTable from "../Components/Ui/DataTable.vue";
import SimpleCard from "../Components/Ui/SimpleCard.vue";
import ModalTask from "../Components/Ui/ModalTask.vue";

const {makeRequest} = useRequest('task');
const { user, loadUserFromToken } = useAuth();
const columns = ["ID", "Task", "Status", "Tags", "Date"];

const modalNewTask = ref(false);

onMounted(() => {
  loadUserFromToken();
});
</script>
