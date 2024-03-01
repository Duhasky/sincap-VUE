<template>
  <div
    class="flex flex-row gap-2 w-full h-full overflow-y-auto overflow-x-auto rounded-md border dark:border-gray-700"
  >
    <template v-for="img in person.photos">
      <div>
        <img
          class="h-auto max-w-xl rounded-lg shadow-xl dark:shadow-gray-800"
          :src="'../' + img.photo"
        />
      </div>
    </template>
  </div>
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
