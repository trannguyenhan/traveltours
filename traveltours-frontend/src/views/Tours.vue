<template>
  <div>
    <div class="tour-list">
      <TrnGrid />
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex';
  import TrnGrid from '@/components/Tours/Grid.vue';

  export default {
    name: 'Home',
    components: {
      TrnGrid,
    },
    computed: {
      ...mapGetters(['getFeaturedTours']),
    },
  };
</script>

<style scoped>
  .tour-list {
    max-width: 1080px !important;
    /* min-height: 800px; */
    margin: auto;
  }
</style>
