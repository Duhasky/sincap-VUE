<template>
  <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <div>
      <template v-for="img in imgs">
        <img
          class="h-auto max-w-full rounded-lg"
          :src="path + img.photo"
          :alt="alt"
        />
      </template>
    </div>
  </div>
</template>

<script setup>
  const path = usePage().props.path_file;
  defineProps(['imgs', 'alt']);
</script>
