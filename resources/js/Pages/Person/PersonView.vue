<template>
  <div
    class="flex flex-row flex-wrap gap-6 w-full h-[60vh] overflow-y-auto overflow-x-auto rounded-md border dark:border-gray-700"
  >
    <template
      v-for="img in person.photos"
      :key="img.id"
    >
      <div @click="openModal(img)">
        <img
          class="w-full h-full border dark:border-gray-600 m-1 object-contain max-w-xl rounded-lg shadow-xl dark:shadow-gray-800 cursor-pointer"
          :src="'../' + img.photo"
          alt="Imagem"
        />
      </div>
    </template>

    <!-- Modal -->
    <div
      v-if="modalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center"
    >
      <div class="max-w-screen-lg w-full mx-auto bg-white p-4 rounded-lg">
        <button
          @click="closeModal"
          class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
        >
          Fechar
        </button>
        <Galery
          :src="'../' + selectedImage"
          alt="Imagem em tela cheia"
          class="w-full h-full object-contain"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  import { ref } from 'vue';
  defineOptions({ layout: Layout });

  const auth = usePage().props.auth;
  const form = useForm({});
  const props = defineProps({
    person: Object,
  });

  const modalOpen = ref(false);
  const selectedImage = ref('');

  const openModal = (img) => {
    selectedImage.value = img.photo;
    modalOpen.value = true;
  };

  const closeModal = () => {
    modalOpen.value = false;
  };
</script>
