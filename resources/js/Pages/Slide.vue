<script setup>
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
  slide: Object,
});
</script>

<template>

  <Head title="Slide" />

  <div class="flex flex-col items-center justify-center min-h-screen py-2">
    <div class="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
      <h1 class="text-6xl font-bold">
        {{ slide.title }}
      </h1>

      <p class="mt-3 text-2xl">
        {{ slide.content }}
      </p>  
    </div>
  </div>

</template>

