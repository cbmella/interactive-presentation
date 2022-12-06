<script setup>
import Pusher from "pusher-js";
import Echo from "laravel-echo";
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps({
  player: Object,
  token: String,
});

window.Echo = new Echo({
  broadcaster: "pusher",
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  wsHost:
    import.meta.env.VITE_PUSHER_HOST ??
    `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
  wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
  wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
  forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
  enabledTransports: ["ws", "wss"],
  authorizer: (channel, options) => {
    return {
      authorize: (socketId, callback) => {
        axios
          .post(
            "/api/broadcasting/auth",
            {
              socket_id: socketId,
              channel_name: channel.name,
            },
            { headers: { Authorization: `Bearer ${props.token}` } }
          )
          .then((response) => {
            callback(false, response.data);
          })
          .catch((error) => {
            callback(true, error);
          });
      },
    };
  },
});


window.Echo.private(`Player.${props.player.id}`).listen("activeSlide", (event) =>
  console.log(event)
);
</script>

<template>

  <Head title="Presentation" />
  <h1>xD</h1>
  <!-- 
  <div class="flex flex-col items-center justify-center min-h-screen py-2">
    <div class="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
      <h1 class="text-6xl font-bold">
        {{ presentation.title }}
      </h1>
      <Link
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        :href="route('presentations.ready', [presentation.id])">
      Comenzar
      </Link>
    </div>
  </div> -->

</template>

