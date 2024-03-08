<template>
  <h2
    class="text-2xl text-center text-gray-900 dark:text-gray-100 pb-4"
    v-html="'Novo Cadastro de Pessoa'"
  />

  <form @submit.prevent="save">
    <div>
      <InputLabel
        for="name"
        value="Nome"
      />
      <TextInput
        id="name"
        type="text"
        class="mt-1 block w-full"
        v-model="form.name"
      />
      <InputError
        class="mt-2"
        :message="form.errors.name"
      />
    </div>

    <div class="mt-4">
      <InputLabel
        for="surname"
        value="Apelido"
      />
      <TextInput
        id="surname"
        type="text"
        class="mt-1 block w-full"
        v-model="form.surname"
      />
      <InputError
        class="mt-2"
        :message="form.errors.surname"
      />
    </div>

    <div class="mt-4">
      <InputLabel
        for="name_mother"
        value="Nome da Mãe"
      />
      <TextInput
        id="name_mother"
        type="text"
        class="mt-1 block w-full"
        v-model="form.name_mother"
      />
      <InputError
        class="mt-2"
        :message="form.errors.name_mother"
      />
    </div>
    <div class="mt-4">
      <InputLabel
        for="date_birth"
        value="Data de Nascimento"
      />
      <TextInput
        id="date_birth"
        type="date"
        class="mt-1 block w-full"
        v-model="form.date_birth"
      />
    </div>
    <InputError
      class="mt-2"
      :message="form.errors.date_birth"
    />
    <div class="mt-4">
      <InputLabel
        for="group"
        value="Facção"
      />
      <Select
        id="group"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        v-model="form.group_id"
        :dataset="groups"
      />
    </div>
    <div class="mt-4">
      <InputLabel
        for="city"
        value="Cidade"
      />
      <Select
        id="city"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        v-model="form.city_id"
        :dataset="cities"
      />
      <InputError
        class="mt-2"
        :message="form.errors.city_id"
      />
    </div>
    <div class="mt-4">
      <InputLabel
        for="description"
        value="Descrição"
      />
      <textarea
        id="description"
        rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        v-model="form.description"
        placeholder="Descrição"
      />
      <InputError
        class="mt-2"
        :message="form.errors.description"
      />
    </div>

    <div class="mt-4">
      <InputLabel
        for="photos"
        value="Fotos"
      />
      <InputFile
        id="photos"
        @input="form.photos = $event.target.files"
        required
      />
      <InputError
        class="mt-2"
        :message="form.errors.photos"
      />
      <progress
        v-if="form.progress"
        :value="form.progress.percentage"
        max="100"
      >
        {{ form.progress.percentage }}%
      </progress>
    </div>

    <div class="flex items-center justify-end mt-4">
      <DangerButton
        @click.prevent="cancelNew"
        v-text="'Voltar'"
      />
      <PrimaryButton
        type="submit"
        class="mx-2"
        :class="{ 'opacity-25': form.processing }"
        v-html="'Salvar'"
      />
    </div>
  </form>

  <!-- Modal -->
  <Modal :show="modal">
    <div class="p-6">
      <h2
        class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-4"
        v-text="cityOrGroup"
      />
      <form @submit.prevent="saveGroupCity">
        <div>
          <InputLabel
            for="name"
            value="Nome"
          />
          <TextInput
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            autocomplete="name"
          />
          <InputError
            class="mt-2"
            :message="form.errors.name"
          />
        </div>

        <div class="flex items-center justify-end mt-4">
          <DangerButton
            @click.prevent="modalOpenClose"
            v-html="'Cancelar'"
          />
          <PrimaryButton
            type="submit"
            class="mx-2"
            :class="{ 'opacity-25': form.processing }"
            v-html="'Salvar'"
          />
        </div>
      </form>
    </div>
  </Modal>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  import { ref } from 'vue';
  defineOptions({ layout: Layout });
  const props = defineProps({
    groups: Object,
    cities: Object,
  });

  const form = useForm({
    name: '',
    surname: '',
    date_birth: '',
    name_mother: '',
    description: '',
    group_id: 0,
    city_id: 0,
    photos: [],
  });

  const save = () => {
    form.post(route('person.store'), {
      onSuccess: () => {
        form.reset();
      },
    });
  };
  const cancelNew = () => {
    router.get(route('person.management'));
  };

  const cityOrGroup = ref('');
  const modal = ref(false);

  const modalOpenClose = () => {
    modal.value = !modal.value;
  };
  const ModalShow = (param) => {
    modalOpenClose();
    if (param == 'city') {
      cityOrGroup.value = 'Nova Cidade';
    }
    if (param == 'group') {
      cityOrGroup.value = 'Novo Grupo';
    }
  };

  const saveGroupCity = () => {
    if (cityOrGroup.value == 'Nova Cidade') {
      //criar cidade
      form.post(route('city.create'));
    }
    if (cityOrGroup.value == 'Novo Grupo') {
      //criar grupo
      form.post(route('group.create'));
    }
  };
</script>
