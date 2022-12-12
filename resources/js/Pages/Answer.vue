<script setup>
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
  correct_answer: Object,
  msg: String,
});

</script>

<template>

  <Head title="Answer" />

  <div class="container-fluid vh-100 d-flex flex-column">
    <div class="row my-auto">
      <div v-if="correct_answer" class="col text-center">
        {{ msg }} <br>
        la respuesta correcta es : {{ correct_answer.content }}
      </div>
      <div v-else class="col text-center">
        {{ msg }}
      </div>
    </div>
  </div>

</template>
