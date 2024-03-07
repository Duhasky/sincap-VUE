<template>
  <div
    class="overflow-y-auto h-[60vh] border border-double dark:border-gray-300 rounded-md flex flex-wrap"
  >
    <template v-for="img in person.photos">
      <img
        class="h-full w-full md:w-auto cursor-pointer"
        :src="path + img.photo"
        alt="image description"
      />
    </template>
  </div>

  <div class="mt-3">
    <span class="flex">
      <h1
        class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
        v-text="person.surname"
      />
    </span>
    <h2
      class="mb-2 font-normal text-gray-900 dark:text-gray-200"
      v-text="person.name"
    />
    <p class="font-normal text-gray-700 dark:text-gray-400">
      Mãe: {{ person.name_mother }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
      Data de Nascimento: {{ person.date_birth }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
      Cidade: {{ person.city.name }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
      Grupo: {{ person.group.name }}
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
      Descrição: {{ person.description }}
    </p>
  </div>
  <div class="mt-3 flex gap-x-1">
    <Link
      class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
      :href="route('person.management')"
      v-text="'Voltar'"
    />
    <PrimaryButton
      v-text="'Editar'"
      @click.prevent="form.get(route('person.edit', person.id))"
    />
    <DangerButton
      @click.prevent="confirmUserDeletion(person, person.surname)"
      v-text="'Deletar'"
    />
  </div>

  <!-- Modal -->
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
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            v-html="'Deletar'"
          />
        </form>
      </div>
    </div>
  </Modal>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  defineOptions({ layout: Layout });

  const auth = usePage().props.auth;
  const path = usePage().props.path_file;
  const form = useForm({});
  const props = defineProps({
    person: Object,
  });

  const deletePerson = (person) => {
    form.delete(route('person.delete', person));
    form.get(route('person.management'));
  };

  const modalOpenClose = () => {
    personDeleteModal.value = !personDeleteModal.value;
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
