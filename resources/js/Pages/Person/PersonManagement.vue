<template>
  <div class="flex flex-row flex-wrap gap-2">
    <template v-for="person in persons">
      <div>
        <Caroussel :slides="person.photos">
          <template #surname> {{ person.surname }}</template>
          <template #name> {{ person.name }}</template>
        </Caroussel>
      </div>
    </template>
  </div>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  defineOptions({ layout: Layout });

  const auth = usePage().props.auth;

  const props = defineProps({
    persons: Object,
  });
</script>

<style lang="scss" scoped></style>
