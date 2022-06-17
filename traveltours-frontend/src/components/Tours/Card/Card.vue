<template>
  <H3TBaseCard class="grid-card" style="max-width: 400px">
    <div class="card-header">
      <router-link :to="'/tour/' + tour.id">
        <v-img
          aspect-ratio="1.4"
          class="white--text align-end rounded-tr-xl"
          :src="tour.dest.images[0]"
        >
          <H3TSavingRibbon
            :price="tour.price.adult"
            :old-price="tour.price.adult + 10"
        /></v-img>
        <H3TCardName :name="tour.dest.name" />
      </router-link>
    </div>

    <H3TQuickFacts :tour="tour" style="font-size: 14px" v-on="$listeners" />
  </H3TBaseCard>
</template>

<script>
  import H3TBaseCard from '@/components/base/Card';
  import H3TCardName from './CardName.vue';
  import H3TSavingRibbon from './SavingRibbon.vue';
  import H3TQuickFacts from './quickFacts.vue';

  export default {
    components: {
      H3TSavingRibbon,
      H3TCardName,
      H3TBaseCard,
      H3TQuickFacts,
    },

    props: {
      tour: {
        type: Object,
        required: true,
      },
    },
  };
</script>

<style scoped>
  .card-header {
    position: relative;
    margin-bottom: 2em;
  }
</style>
