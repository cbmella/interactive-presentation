<script setup>
import { watchEffect } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { useTimer } from "vue-timer-hook";

const props = defineProps({
  question: Object,
  answers: Object,
});

const time = new Date();
time.setSeconds(time.getSeconds() + props.question.time);
const timer = useTimer(time);

const restart = () => {
  form.answer = null
  const time = new Date();
  time.setSeconds(time.getSeconds() + props.question.time);
  timer.restart(time);
}

const form = useForm({
  question: props.question.id,
  answer: null,
  timeLeft: timer,
});

const submit = () => {
  form.post(route('mobile.store.progress'), {
    onFinish: () => restart(),
  });
};

watchEffect(() => {
  if (timer.isExpired.value) {
    //submit();
  }
})
</script>

<template>
  <form class="container-fluid container-fluid vh-100 d-flex flex-column" @submit.prevent="submit">
    <p v-if="question">{{ question.content }}</p>

    <div v-if="answers" v-for="answer in answers" :key="answer.id">
      <input type="radio" v-model="form.answer" :value="answer.id" />
      <label :for="answer.id">{{ answer.content }}</label>
    </div>

    <div v-if="time">
      <h1 v-if="timer.minutes"> {{ timer.minutes }}:</h1>
      <h1 v-if="timer.seconds"> {{ timer.seconds }} </h1>
    </div>

    <button :disabled="form.processing" class="">Siguiente</button>
  </form>
</template>
