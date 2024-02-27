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
            v-for="slide in slides"
            :key="slide.id"
            :class="{ hidden: slide.id !== activeSlide }"
            class="duration-700 ease-in-out"
          >
            <img
              :src="slide.photo"
              class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
            />
          </div>
        </div>
        <!-- Slider indicators -->
        <div
          class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2"
        >
          <button
            v-for="slide in slides"
            :key="slide.id"
            type="button"
            :class="{
              'w-3 h-3 rounded-full': true,
              'bg-gray-800': slide.id === activeSlide,
              'bg-white': slide.id !== activeSlide,
            }"
            @click="changeSlide(slide.id)"
            :aria-current="slide.id === activeSlide"
            :aria-label="`Slide ${slide.id + 1}`"
          />
        </div>

        <!-- Slider controls -->
        <button
          type="button"
          class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
          @click="prevSlide"
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
          @click="nextSlide"
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
      <div class="p-2">
        <p class="text-gray-600 dark:text-gray-400">
          Descrição do card aqui. Lorem ipsum dolor sit amet,
          consecteturadipiscing elit. Sed do eiusmod tempor incididunt ut labore
          et dolore magna aliqua.
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
  const activeSlide = ref(0);
  const props = defineProps(['slides']);

  const changeSlide = (index) => {
    activeSlide.value = index;
  };

  const nextSlide = () => {
    activeSlide.value = (activeSlide.value + 1) % props.slides.length;
  };

  const prevSlide = () => {
    activeSlide.value =
      (activeSlide.value - 1 + props.slides.length) % props.slides.length;
  };
</script>

<style scoped></style>
