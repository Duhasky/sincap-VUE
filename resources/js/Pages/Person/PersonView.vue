<template>
  <div
    class="overflow-y-auto h-[60vh] border border-double dark:border-gray-300 rounded-md"
  >
    <template v-for="img in person.photos">
      <a @click.prevent="confirmDownload(img.photo)">
        <img
          class="h-full w-full md:w-auto cursor-pointer"
          :src="path + img.photo"
          alt="image description"
        />
      </a>
    </template>
  </div>

  <div class="mt-3">
    <span class="flex">
      <h1
        class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
        v-text="person.surname"
      />
      <div class="ml-6 flex gap-x-1">
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
          @click.prevent="deletePerson(person)"
          v-text="'Deletar'"
        />
      </div>
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

  const confirmDownload = (photoPath) => {
    const isConfirmed = window.confirm('Deseja fazer o download desta imagem?');

    if (isConfirmed) {
      // Lógica para iniciar o download
      initiateDownload(photoPath);
    }
  };

  const initiateDownload = (photoPath) => {
    const downloadLink = document.createElement('a');
    downloadLink.href = `../${photoPath}`;
    downloadLink.download = '';
    downloadLink.click();
  };

  const deletePerson = (person) => {
    form.delete(route('person.delete', person));
    form.get(route('person.management'));
  };
</script>
