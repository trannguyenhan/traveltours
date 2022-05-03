<template>
  <v-btn large icon @click="heart = !heart">
    <v-icon v-if="!heart" class="primary--text text--lighten-4">
      mdi-heart-outline
    </v-icon>
    <v-icon v-else class="heart-beat pink--text"> mdi-heart </v-icon>
  </v-btn>
</template>

<script>
  export default {
    data: () => ({
      heart: false,
    }),
  };
</script>

<style scoped>
  @keyframes heartbeat {
    0% {
      transform: scale(1);
    }
    20% {
      transform: scale(1.4);
    }
    35% {
      transform: scale(1.8);
    }
    60% {
      transform: scale(1.4);
    }
    80% {
      transform: scale(1.8);
    }
    90% {
      transform: scale(1.4);
    }
    100% {
      transform: scale(1);
    }
  }

  .heart-beat {
    animation: heartbeat 1.5s;
  }
</style>
