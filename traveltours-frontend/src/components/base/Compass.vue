<template>
  <span
    ><v-icon
      :class="$vuetify.breakpoint.mdAndUp ? 'mx-n12' : 'mx-n6'"
      class="primary--text spin mb-7"
      size="1.4em"
      >mdi-compass</v-icon
    ></span
  >
</template>

<script>
  export default {};
</script>

<style scoped>
  .spin {
    animation-name: spin;
    animation-duration: 2000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    25% {
      transform: rotate(180deg);
    }
    50% {
      transform: rotate(60deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
</style>
