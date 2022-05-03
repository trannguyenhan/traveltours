<template>
  <SkewText class="card-name text-h4 pt-n4 pb-4">
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
    text-align: left;
    margin: auto;
    /* max-width: 300px; */
    line-height: 1.5em;
    /* width: 70%; */
  }
</style>
