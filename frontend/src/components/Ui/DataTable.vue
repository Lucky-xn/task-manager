<template>
  <div
    class="p-2 w-full h-full overflow-y-scroll"
  >
    <table class="w-full">
      <thead>
        <tr class="flex w-full gap-1">
          <th v-for="(column, index) in columns" :key="index" class="flex flex-1">
            <span
              class="flex flex-1 items-center px-2 border border-transparent rounded-md hover:border-neutral-700 transition-all duration-300 cursor-pointer"
              >{{ column }}</span
            >
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in data" :key="item.id ? `${item.id}-${index}` : `row-${index}`" class="flex flex-1 w-full gap-1">
          <td class="flex flex-1">
            <span class="flex flex-1 items-center justify-center">
              <slot name="row" :item="item" :index="index"></slot>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
defineProps({
  columns: {
    type: Array,
    required: true,
  },
  data: {
    type: Array,
    required: true,
  },
});
</script>
