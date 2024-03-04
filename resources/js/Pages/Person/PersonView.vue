<template>
  <div
    class="overflow-y-auto h-[60vh] border border-double dark:border-gray-300 rounded-md"
  >
    <template v-for="img in person.photos">
      <a @click.prevent="confirmDownload(img.photo)">
        <img
          class="h-full w-full md:w-auto cursor-pointer"
          :src="`../${img.photo}`"
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
      <SecondaryButton
        class="ml-12"
        v-text="'Editar'"
        @click.prevent="form.get(route('person.edit', person.id))"
      />
      <DangerButton
        @click.prevent="deletePerson(person)"
        class="ml-1"
        v-text="'Deletar'"
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
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  defineOptions({ layout: Layout });

  const auth = usePage().props.auth;
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
