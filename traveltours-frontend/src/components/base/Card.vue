<template>
  <v-card flat class="base-card rounded-tr-xl rounded-bl-xl">
    <slot />
  </v-card>
</template>

<script>
  export default {};
</script>

<style scoped>
  .base-card {
    margin: auto;
    height: 100%;
    width: 100%;
    background: #e8fdff7b;
  }

  .base-card:hover {
    background: #ebfeffd7;
    transition: transform 500ms ease-in-out;
    transform: scale(1.05);
  }

  .base-card:not(:hover) {
    transition: transform 500ms ease-in-out;
    transform: scale(1);
  }
</style>
