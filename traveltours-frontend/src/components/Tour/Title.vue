<template>
  <SkewText background class="card-name py-6">
    <slot />
  </SkewText>
</template>

<script>
  import SkewText from '../base/SkewText.vue';

  export default {
    components: { SkewText },
  };
</script>

<style scoped>
  .card-name {
    text-align: center;
    margin: auto;
    /* max-width: 300px; */
    bottom: 0.3em;
    line-height: 1.5em;
    /* width: 70%; */
  }
</style>
