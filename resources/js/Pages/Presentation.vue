<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
  presentation: Object,
});
</script>

<template>

  <Head title="Presentation" />

  <div class="flex flex-col items-center justify-center min-h-screen py-2">
    <div class="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
      <h1 class="text-6xl font-bold">
        {{ presentation.title }}
      </h1>
      <Link class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" :href="route('slides.show', [presentation.id])">
      Siguiente
      </Link>
    </div>
  </div>

</template>

