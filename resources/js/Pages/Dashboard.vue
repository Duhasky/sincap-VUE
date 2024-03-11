<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  defineOptions({ layout: Layout });

  defineProps({
    persons: Number,
    users: Number,
    cities: Number,
    groups: Number,
  });
</script>

<template>
  <div class="max-w-7xl mx-auto">
    <div
      class="bg-white dark:bg-gray-800 dark:text-gray-100 overflow-hidden rounded-lg"
    >
      <div class="flex flex-wrap text-center m-2 min-w-44">
        <Link
          :href="route('user.management')"
          class="p-4 xl:w-1/6 md:w-1/4 sm:w-1/2 w-full"
        >
          <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
            <p class="leading-relaxed dark:text-gray-300">Usuários</p>
            <h2
              class="title-font font-medium text-3xl text-gray-900 dark:text-gray-300"
              v-text="users"
            />
          </div>
        </Link>

        <Link
          :href="route('person.management')"
          class="p-4 xl:w-1/6 md:w-1/4 sm:w-1/2 w-full"
        >
          <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
            <p class="leading-relaxed dark:text-gray-300">Pessoas</p>
            <h2
              class="title-font font-medium text-3xl text-gray-900 dark:text-gray-300"
              v-text="persons"
            />
          </div>
        </Link>

        <Link
          :href="route('city.management')"
          class="p-4 xl:w-1/6 md:w-1/4 sm:w-1/2 w-full"
        >
          <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
            <p class="leading-relaxed dark:text-gray-300">Cidades</p>
            <h2
              class="title-font font-medium text-3xl text-gray-900 dark:text-gray-300"
              v-text="cities"
            />
          </div>
        </Link>

        <Link
          :href="route('group.management')"
          class="p-4 xl:w-1/6 md:w-1/4 sm:w-1/2 w-full"
        >
          <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
            <p class="leading-relaxed dark:text-gray-300">Grupos</p>
            <h2
              class="title-font font-medium text-3xl text-gray-900 dark:text-gray-300"
              v-text="groups"
            />
          </div>
        </Link>
      </div>
    </div>
  </div>
</template>
