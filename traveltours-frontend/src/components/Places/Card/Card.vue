<template>
  <H3TBaseCard class="grid-card" style="max-width: 400px">
    <div class="card-header">
      <router-link :to="'/place/' + place.id">
        <v-img
          aspect-ratio="1.4"
          class="white--text align-end rounded-tr-xl"
          :src="place.images[0]"
        />
        <H3TCardName :name="place.name" />
      </router-link>
    </div>

    <H3TQuickFacts :place="place" style="font-size: 14px" v-on="$listeners" />
  </H3TBaseCard>
</template>

<script>
  import H3TBaseCard from '@/components/base/Card';
  import H3TCardName from './CardName.vue';
  import H3TSavingRibbon from './SavingRibbon.vue';
  import H3TQuickFacts from './quickFacts.vue';

  export default {
    components: {
      H3TCardName,
      H3TBaseCard,
      H3TQuickFacts,
    },

    props: {
      place: {
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
