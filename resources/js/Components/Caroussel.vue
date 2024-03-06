<template>
  <div class="w-auto bg-white dark:bg-gray-700 rounded-lg">
    <!-- Cabeçalho -->
    <div class="bg-gray-200 dark:bg-gray-600 p-4 rounded-lg">
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
    <div
      class="relative w-auto"
      v-if="pictures.length <= 1"
    >
      <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <img
          :src="path + pictures[0].photo"
          class="block absolute top-1/2 left-1/2 w-auto -translate-x-1/2 -translate-y-1/2"
        />
      </div>
    </div>
    <div
      class="relative w-auto"
      v-else
    >
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
            :src="path + picture.photo"
            class="block absolute top-1/2 left-1/2 w-auto -translate-x-1/2 -translate-y-1/2"
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
          <i-mingcute-left-fill
            class="w-10 h-10 text-white dark:text-gray-800 rtl:rotate-180 hover:text-gray-500 dark:hover:text-white"
            aria-hidden="true"
            fill="none"
          />
          <span class="sr-only">Anterior</span>
        </button>
        <button
          class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
          data-carousel-next
          type="button"
          @click.prevent="nextPicture"
        >
          <i-mingcute-right-fill
            class="w-10 h-10 text-white dark:text-gray-800 rtl:rotate-180 hover:text-gray-500 dark:hover:text-white"
            aria-hidden="true"
            fill="none"
          />
          <span class="sr-only">Próximo</span>
        </button>
      </template>
    </div>

    <!-- Descrição -->
    <div class="p-2 text-gray-600 dark:text-gray-400 border-t border-gray-400">
      <slot name="footer"></slot>
    </div>
  </div>
</template>

<script setup>
  const path = usePage().props.path_file;

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
