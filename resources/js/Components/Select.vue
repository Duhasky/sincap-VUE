<template>
  <select
    id="group"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    v-model="model"
  >
    <option
      selected
      :value="0"
    >
      Selecione...
    </option>
    <template v-for="data in dataset">
      <option
        :value="data.id"
        v-text="data.name"
      />
    </template>
  </select>
</template>

<script setup>
  defineProps(['dataset']);
  const model = defineModel({ type: Number, required: true });
</script>
