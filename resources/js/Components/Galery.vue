<template>
  <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <div>
      <img
        class="h-auto max-w-full rounded-lg"
        :src="img"
        :alt="alt"
      />
    </div>
  </div>
</template>

<script setup>
  defineProps(['img', 'alt']);
</script>
