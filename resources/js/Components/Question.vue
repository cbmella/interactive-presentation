<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { watchEffect } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { useTimer } from "vue-timer-hook";

const props = defineProps({
  slide: Object,
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
  slide: props.slide.id,
  question: props.question.id,
  answer: null,
  timeLeft: timer,
});

const submit = () => {
  form.post(route('progress.store'), {
    onFinish: () => restart(),
  });
};

watchEffect(() => {
  if (timer.isExpired.value) {
    submit();
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

    <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
      Siguiente
    </PrimaryButton>
  </form>
</template>
