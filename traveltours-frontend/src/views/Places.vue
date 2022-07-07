<template>
  <div>
    <div class="place-list">
      <TrnGrid />
    </div>
  </div>
</template>

<script>
  import TrnGrid from '@/components/Places/Grid.vue';

  export default {
    name: 'Places',
    components: {
      TrnGrid,
    },
  };
</script>

<style scoped>
  .place-list {
    max-width: 1080px !important;
    /* min-height: 800px; */
    margin: auto;
  }
</style>
