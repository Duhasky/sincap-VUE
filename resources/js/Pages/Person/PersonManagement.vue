<template>
  <Modal :show="personDeleteModal">
    <div class="p-6">
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Tem certeza de que deseja excluir esta Pessoa? <br />
        ({{ personNameBeingAction }})
      </h2>
      <div class="mt-6 flex justify-end">
        <form @submit.prevent="deletePerson(personBeingAction)">
          <SecondaryButton
            class="mx-2"
            @click.prevent="modalOpenClose"
            v-html="'Cancelar'"
          />
          <DangerButton
            v-if="auth.abilities.includes('person_delete')"
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            v-html="'Deletar'"
          />
        </form>
      </div>
    </div>
  </Modal>
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
        v-if="auth.abilities.includes('person_create')"
        @click.prevent="newPerson"
        class="ml-2 justify-end align-middle"
        v-html="'Novo'"
      />
    </div>
  </div>
  <!-- Form de pesquisa -->

  <div class="flex flex-row flex-wrap gap-2">
    <template v-for="person in persons.data">
      <div class="w-full sm:w-auto">
        <Caroussel :pictures="person.photos">
          <template #surname> {{ person.surname }}</template>
          <template #buttons>
            <Link
              :href="route('person.view', person.id)"
              v-if="auth.abilities.includes('person_read')"
            >
              <i-mdi-eye-outline class="text-2xl text-yellow-300" />
            </Link>
            <button
              v-if="auth.abilities.includes('person_delete')"
              @click.prevent="confirmUserDeletion(person, person.surname)"
            >
              <i-ic-outline-delete class="text-2xl text-red-600" />
            </button>
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
  const form = useForm({});
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

  const modalOpenClose = () => {
    personDeleteModal.value = !personDeleteModal.value;
  };
  const deletePerson = (id) => {
    form.delete(route('person.delete', id), {
      preserveScroll: true,
      onSuccess: () => {
        modalOpenClose();
      },
    });
  };

  const personDeleteModal = ref(false);
  const personBeingAction = ref(null);
  const personNameBeingAction = ref(null);

  const confirmUserDeletion = (id, name) => {
    modalOpenClose();
    personBeingAction.value = id;
    personNameBeingAction.value = name;
  };
</script>
