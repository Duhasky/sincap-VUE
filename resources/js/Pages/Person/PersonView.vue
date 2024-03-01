<template>
  {{ console.log(person) }}
  <div>View</div>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  defineOptions({ layout: Layout });

  const auth = usePage().props.auth;
  const form = useForm({});
  const props = defineProps({
    person: Object,
  });
</script>

<style lang="scss" scoped></style>
