<template>
  <div class="container mx-auto pr-2">
    <div
      class="max-w-md mx-auto bg-white dark:bg-gray-700 rounded-lg overflow-hidden"
    >
      <!-- Cabeçalho -->
      <div class="bg-gray-200 dark:bg-gray-600 p-4">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
          <slot name="surname"></slot>
        </h2>
        <div class="font-normal text-gray-300">
          <slot name="name"></slot>
        </div>
      </div>

      <!-- Imagem -->
      <div class="relative w-full">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
          <!-- Iterar sobre os slides -->
          <div
            v-for="s in slide.photos"
            :key="s.id"
            :class="{ hidden: s.id !== activeSlide }"
            class="duration-700 ease-in-out"
          >
            <img
              :src="s.photo"
              class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
            />
          </div>
        </div>
        <!-- Slider indicators -->
        <div
          class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2"
        >
          <button
            v-for="s in slide.photos"
            :key="s.id"
            type="button"
            :class="{
              'w-3 h-3 rounded-full': true,
              'bg-gray-800': s.id === activeSlide,
              'bg-white': s.id !== activeSlide,
            }"
            @click="changeSlide(s.id)"
            :aria-current="s.id === activeSlide"
            :aria-label="`Slide ${s.id + 1}`"
          />
        </div>

        <!-- Slider controls -->
        <button
          type="button"
          class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
          @click="prevSlide(slide.photos)"
        >
          <i-mingcute-left-fill
            class="w-10 h-10 text-white dark:text-gray-800 rtl:rotate-180 hover:text-gray-800 dark:hover:text-white"
            aria-hidden="true"
            fill="none"
          />
          <span class="sr-only">Anterior</span>
        </button>
        <button
          type="button"
          class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
          @click="nextSlide(slide.photos)"
        >
          <i-mingcute-right-fill
            class="w-10 h-10 text-white dark:text-gray-800 rtl:rotate-180 hover:text-gray-800 dark:hover:text-white"
            aria-hidden="true"
            fill="none"
          />
          <span class="sr-only">Próximo</span>
        </button>
      </div>

      <!-- Descrição -->
      <div
        class="p-2 text-gray-600 dark:text-gray-400 border-t border-gray-400"
      >
        <slot name="footer"></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
  const activeSlide = ref(0);
  defineProps(['slide']);

  const changeSlide = (index) => {
    activeSlide.value = index;
  };

  const nextSlide = (imgs) => {
    activeSlide.value = (activeSlide.value + 1) % imgs.length;
  };

  const prevSlide = (imgs) => {
    activeSlide.value = (activeSlide.value - 1 + imgs.length) % imgs.length;
  };
</script>

<style scoped></style>
