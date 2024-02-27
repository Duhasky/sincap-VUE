<template>
  <div class="p-6">
    <h2
      class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-4"
      v-html="'Novo TAN'"
    />

    <form>
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
          :message="form.errors.name_mother"
        />
      </div>
      <div class="mt-4">
        <InputLabel
          for="address"
          value="Endereço"
        />
        <textarea
          id="address"
          rows="4"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.address"
          placeholder="Endereço"
        />
        <InputError
          class="mt-2"
          :message="form.errors.address"
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
          placeholder="Endereço"
        />
        <InputError
          class="mt-2"
          :message="form.errors.description"
        />
      </div>

      <div class="mt-4">
        <InputLabel
          for="group"
          value="Facção"
        />
        <select
          id="group"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.group_id"
        >
          <option
            selected
            :value="0"
          >
            Selecione a Facção
          </option>
          <template v-for="group in groups">
            <option
              :value="group.id"
              v-text="group.name"
            />
          </template>
        </select>
      </div>
      <div class="mt-4">
        <InputLabel
          for="photos"
          value="Fotos"
        />
        <TextInput
          id="photos"
          type="file"
          class="mt-1 block w-full"
          v-model="form.photos"
        />
        <InputError
          class="mt-2"
          :message="form.errors.photos"
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <DangerButton v-html="'Cancelar'" />
        <PrimaryButton
          type="submit"
          class="mx-2"
          :class="{ 'opacity-25': form.processing }"
          v-html="'Salvar'"
        />
      </div>
    </form>
  </div>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  import { useForm } from '@inertiajs/vue3';
  defineOptions({ layout: Layout });
  const form = useForm({
    name: '',
    surname: '',
    date_birth: '',
    name_mother: '',
    address: '',
    description: '',
    group_id: 0,
    photos: '',
  });

  const props = defineProps({
    groups: Object,
  });
</script>
