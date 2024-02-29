<template>
  <div class="flex flex-row items-center pb-4">
    <!-- Form de pesquisa -->
    <div class="w-full lg:w-3/5">
      <form class="flex items-center">
        <div class="relative w-full">
          <label
            for="nameSearch"
            class="sr-only"
            v-html="'Pesquisar'"
          />
          <TextInput
            class="block w-full"
            id="nameSearch"
            type="search"
            v-model="nameSearch"
            autocomplete="current-name"
            placeholder="Pesquisar por nome"
          />
        </div>
      </form>
    </div>
    <!-- Form de pesquisa -->
    <div>
      <PrimaryButton
        @click.prevent="newPerson"
        class="ml-2 justify-end align-middle"
        v-html="'Novo'"
      />
    </div>
  </div>
  <!-- Form de pesquisa -->

  <div class="flex flex-row flex-wrap gap-2">
    <template v-for="person in persons.data">
      <div>
        <Caroussel :slide="person">
          <template #surname> {{ person.surname }}</template>
          <template #buttons>
            <i-mdi-eye-outline class="text-2xl text-yellow-300" />
            <i-ic-outline-delete class="text-2xl text-red-600" />
          </template>
          <template #name> {{ person.name }}</template>
          <template #footer>
            <div>
              <span>
                <span
                  class="font-bold pr-2"
                  v-text="'Facção:'"
                />
                <span
                  class="font-normal"
                  v-text="person.group.name"
                />
              </span>
            </div>
            <div>
              <span>
                <span
                  class="font-bold pr-2"
                  v-text="'Mãe:'"
                />
                <span
                  class="font-normal"
                  v-text="person.name_mother"
                />
              </span>
            </div>
            <div>
              <span>
                <span
                  class="font-bold pr-2"
                  v-text="'Descrição:'"
                />
                <span
                  class="font-normal"
                  v-text="person.description"
                />
              </span>
            </div>
          </template>
        </Caroussel>
      </div>
    </template>
  </div>
  <div v-if="!shouldHidePagination">
    <Pagination :data="persons" />
  </div>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  import debounce from 'lodash/debounce';
  defineOptions({ layout: Layout });

  const auth = usePage().props.auth;

  const props = defineProps({
    filters: Object,
    persons: Object,
  });

  const shouldHidePagination = computed(
    () => !props.persons.prev_page_url && !props.persons.next_page_url,
  );

  const nameSearch = ref(props.filters.search || '');

  watch(
    nameSearch,
    debounce(function (value) {
      router.get(
        route('person.management'),
        { search: value },
        { preserveState: true, replace: true },
      );
    }, 500),
  );

  const newPerson = () => {
    router.get(route('person.create'));
  };
</script>

<style lang="scss" scoped></style>
