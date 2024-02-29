<template>
  <div class="container mx-auto pr-2">
    <div
      class="max-w-md mx-auto bg-white dark:bg-gray-700 rounded-lg overflow-hidden"
    >
      <!-- Cabeçalho -->
      <div class="bg-gray-200 dark:bg-gray-600 p-4">
        <div>
          <h2 class="text-xl font-bold text-gray-800 dark:text-white">
            <slot name="surname" />
          </h2>
          <h1 class="float-end justify-start mt-[-30px]">
            <slot name="buttons" />
          </h1>
        </div>
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
            v-for="(picture, index) in pictures"
            :key="index"
            :class="{ hidden: index === currentPicture }"
            class="absolute inset-0 -translate-y-0"
          >
            <img
              :src="'storage/' + picture.photo"
              class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
            />
          </div>
        </div>
        <!-- Slider indicators -->
        <div
          v-if="!noIndicators"
          class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2"
        >
          <button
            v-for="(picture, index) in pictures"
            :key="index"
            :aria-label="'Slide ' + index"
            :class="index === currentPicture ? 'bg-white' : 'bg-white/50'"
            aria-current="false"
            class="w-3 h-3 rounded-full bg-white"
            type="button"
            @click.prevent="slideTo(index)"
          />
        </div>

        <!-- Slider controls -->
        <template v-if="!noControls">
          <button
            class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
            data-carousel-prev
            type="button"
            @click.prevent="previousPicture"
          >
            <span
              class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
            >
              <svg
                class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M15 19l-7-7 7-7"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                />
              </svg>
              <span class="hidden">Previous</span>
            </span>
          </button>
          <button
            class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
            data-carousel-next
            type="button"
            @click.prevent="nextPicture"
          >
            <span
              class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
            >
              <svg
                class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9 5l7 7-7 7"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                />
              </svg>
              <span class="hidden">Next</span>
            </span>
          </button>
        </template>
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
  import { onMounted, ref } from 'vue';

  const props = defineProps({
    pictures: Object,
    noIndicators: {
      type: Boolean,
      default: false,
    },
    noControls: {
      type: Boolean,
      default: false,
    },
    slide: {
      type: Boolean,
      default: false,
    },
    slideInterval: {
      type: Number,
      default: 3000,
    },
    animation: {
      type: Boolean,
      default: false,
    },
  });

  const currentPicture = ref(0);
  const direction = ref('');
  const interval = ref();

  const automaticSlide = () => {
    interval.value = setInterval(function () {
      nextPicture();
    }, props.slideInterval);
  };

  const resetInterval = () => {
    clearInterval(interval.value);
    automaticSlide();
  };

  const slideTo = (index) => {
    currentPicture.value = index;
    resetInterval();
  };

  const nextPicture = () => {
    if (currentPicture.value !== props.pictures.length - 1) {
      currentPicture.value++;
    } else {
      currentPicture.value = 0;
    }
    direction.value = 'right';
    resetInterval();
  };

  const previousPicture = () => {
    if (currentPicture.value !== 0) {
      currentPicture.value--;
    } else {
      currentPicture.value = props.pictures.length - 1;
    }
    direction.value = 'left';
    resetInterval();
  };

  onMounted(() => {
    if (props.slide) {
      automaticSlide();
    }
  });
</script>

<style scoped></style>
