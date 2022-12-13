<script setup>
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
  topPlayers: Object,
});
</script>

<template>

  <Head title="Top players" />

  <div class="h-screen flex flex-col items-center justify-center">
    <div class="w-full sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12">
      <table class="w-full text-left table-collapse">
        <thead class="bg-gray-300">
          <tr>
            <th class="px-4 py-2" scope="col">#</th>
            <th class="px-4 py-2" scope="col">Name</th>
            <th class="px-4 py-2" scope="col">Score</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(player, index) in topPlayers" :key="player.id">
            <th class="border px-4 py-2" scope="row">{{ index + 1 }}</th>
            <td class="border px-4 py-2">{{ player.name }}</td>
            <td class="border px-4 py-2">{{ player.points }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
