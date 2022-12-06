<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const props = defineProps({
  name: String,
  avatar: String,
  url: String,
  player: Object,
  token: String,
});

const form = useForm({
  avatar: props.url,
  name: props.name,
  token: props.token,
});

const submit = () => {
  form.put(route('players.next', props.player), {
    onFinish: () => form.reset('avatar', 'name'),
  });
}; 
</script>

<template>

  <Head title="Login" />

  <GuestLayout>
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h1 class="text-center mt-5">OnDemand Live Interactive Case</h1>
        <h2>{{ form.player }}</h2>
      </div>
      <div class="col-12">
        <form @submit.prevent="submit">
          <div class="row">
            <div class="col">
              <div class="mt-5" id="avatar" v-html="avatar" />
              <input type="hidden" class="form-control mt-5" v-model="form.avatar">
              <input type="text" class="form-control mt-5" v-model="form.name" autofocus>
              <InputError class="mt-2" :message="form.errors.name" />
            </div>
          </div>
          <div class="col-12 d-grid gap-2 mt-5">
            <Link
              class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
              :href="route('players.generate', [player.id, token])">
            Generar Usuario
            </Link>
            <button
              class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Siguiente</button>
          </div>
        </form>
      </div>
    </div>
  </GuestLayout>

</template>
