<template>
  <h2
    class="text-2xl text-center text-gray-900 dark:text-gray-100 pb-4"
    v-text="`Atualizar cadastro: ${person.name}`"
  />

  <form @submit.prevent="updatePerson">
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
      <InputError
        class="mt-2"
        :message="form.errors.date_birth"
      />
    </div>
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
      <InputError
        class="mt-2"
        :message="form.errors.group_id"
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
      <div>
        <InputLabel
          for="new_photos"
          value="Novas Fotos"
        />
        <InputFile
          id="new_photos"
          @input="form.new_photos = $event.target.files"
        />
        <InputError
          class="mt-2"
          :message="form.errors.new_photos"
        />
        <progress
          v-if="form.progress"
          :value="form.progress.percentage"
          max="100"
        >
          {{ form.progress.percentage }}%
        </progress>
      </div>
    </div>

    <div class="flex items-center justify-end mt-4">
      <Link
        class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
        :href="route('person.view', person.id)"
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
  <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mt-2">
    <template v-for="img in person.photos">
      <div>
        <img
          @click.prevent="confirmPhotoDeletion(img.id)"
          :src="path + img.photo"
          class="cursor-pointer"
        />
      </div>
    </template>
  </div>
  <Modal :show="photoDeleteModal">
    <div class="p-6">
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Tem certeza de que deseja excluir esta Foto?
      </h2>
      <div class="mt-6 flex justify-end">
        <form @submit.prevent="deletePhoto(photoId)">
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

  const props = defineProps({
    person: Object,
    groups: Object,
    cities: Object,
  });

  const person = props.person;
  const auth = usePage().props.auth;
  const path = usePage().props.path_file;
  const form = useForm({
    id: person.id,
    name: person.name,
    surname: person.surname,
    date_birth: person.date_birth,
    name_mother: person.name_mother,
    description: person.description,
    group_id: person.group_id,
    city_id: person.city_id,
    photos: person.photos,
    new_photos: [],
  });
  const updatePerson = () => {
    form.post(route('person.update'), {
      preserveScroll: true,
      onSuccess: () => {
        router.get(route('person.edit', person.id));
      },
    });
  };

  const photoDeleteModal = ref(false);

  const modalOpenClose = () => {
    photoDeleteModal.value = !photoDeleteModal.value;
  };

  const photoId = ref(null);

  const confirmPhotoDeletion = (id) => {
    modalOpenClose();
    photoId.value = id;
  };

  const deletePhoto = (id) => {
    form.delete(route('photo.delete', id), {
      onSuccess: () => {
        modalOpenClose();
        router.get(route('person.edit', person.id));
      },
    });
  };
</script>
