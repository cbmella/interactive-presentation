<script setup>
import Pusher from "pusher-js";
import Echo from "laravel-echo";
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

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
  Inertia.visit(route('slides.active', event.active_slide))
);
</script>

<template>

  <Head title="Presentation" />
  Avanza en el escritorio

</template>

