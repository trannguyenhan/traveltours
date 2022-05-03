<template>
  <div>
    <H3TCarousels class="mt-n16" :items="getFeaturedTours" link />
    <div class="TourList">
      <H3TGrid />
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex';
  import H3TCarousels from '@/components/Carousels.vue';

  import H3TGrid from '@/components/Tours/Grid.vue';

  export default {
    name: 'Home',
    components: {
      H3TCarousels,
      H3TGrid,
    },
    computed: {
      ...mapGetters(['getFeaturedTours']),
    },
  };
</script>

<style scoped>
  .TourList {
    max-width: 1080px !important;
    margin: auto;
  }
</style>
