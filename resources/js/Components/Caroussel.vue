<template>
  <div class="container mx-auto pr-2">
    <div
      class="max-w-md mx-auto bg-white dark:bg-gray-700 shadow-lg rounded-lg overflow-hidden"
    >
      <!-- Cabeçalho -->
      <div class="bg-gray-200 dark:bg-gray-600 p-4">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
          Título do Card
        </h2>
      </div>

      <!-- Imagem -->
      <div class="relative w-full">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
          <!-- Iterar sobre os slides -->
          <div
            v-for="(slide, index) in slides"
            :key="index"
            :class="{ hidden: index !== activeSlide }"
            class="duration-700 ease-in-out"
          >
            <img
              :src="slide.image"
              class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
              alt="..."
            />
          </div>
        </div>
        <!-- Slider indicators -->
        <div
          class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2"
        >
          <button
            v-for="(slide, index) in slides"
            :key="index"
            type="button"
            :class="{
              'w-3 h-3 rounded-full': true,
              'bg-gray-800': index === activeSlide,
              'bg-white': index !== activeSlide,
            }"
            @click="changeSlide(index)"
            :aria-current="index === activeSlide"
            :aria-label="`Slide ${index + 1}`"
          ></button>
        </div>

        <!-- Slider controls -->
        <button
          type="button"
          class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
          @click="prevSlide"
        >
          <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
          >
            <svg
              class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 6 10"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 1 1 5l4 4"
              />
            </svg>
            <span class="sr-only">Previous</span>
          </span>
        </button>
        <button
          type="button"
          class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
          @click="nextSlide"
        >
          <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
          >
            <svg
              class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 6 10"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 9 4-4-4-4"
              />
            </svg>
            <span class="sr-only">Next</span>
          </span>
        </button>
      </div>

      <!-- Descrição -->
      <div class="p-4">
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

  const slides = [
    { image: 'https://picsum.photos/200' },
    { image: 'https://picsum.photos/300' },
    { image: 'https://picsum.photos/400' },
    { image: 'https://picsum.photos/200' },
    { image: 'https://picsum.photos/200' },
  ];

  const changeSlide = (index) => {
    activeSlide.value = index;
  };

  const nextSlide = () => {
    activeSlide.value = (activeSlide.value + 1) % slides.length;
  };

  const prevSlide = () => {
    activeSlide.value = (activeSlide.value - 1 + slides.length) % slides.length;
  };
</script>

<style lang="scss" scoped></style>
