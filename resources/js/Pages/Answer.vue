<script setup>
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
  correct_answer: Object,
  msg: String,
});

</script>

<template>

  <Head title="Answer" />

  <div class="container-fluid vh-100 d-flex flex-column">
    <div class="row my-auto">
      <div class="col text-center">
        la respuesta correcta es : {{ correct_answer.content }}
        <br>
        {{ msg }}
      </div>
    </div>
  </div>

</template>
