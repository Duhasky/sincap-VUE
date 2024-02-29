<template>
  {{ console.log(person) }}
  <div>View</div>
</template>

<script setup>
  defineProps({
    person: Object,
  });
</script>

<style lang="scss" scoped></style>
