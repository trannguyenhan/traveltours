<template>
  <div style="max-width: 1200px; margin: auto" class="primary--text">
    <v-row class="mt-4">
      <v-col cols="12" md="8">
        <div style="position: relative">
          <H3TCarousels :items="tour.dest.images" />
        </div>
      </v-col>

      <v-col cols="12" md="4">
        <H3TTitle class="text-h4">{{ tour.dest.name }}</H3TTitle>

        <H3TQuickFacts :tour="tour" style="font-size: 16px" v-on="$listeners" />
      </v-col>
    </v-row>

    <v-container class="mt-6">
      <v-row>
        <v-col cols="12" md="8">
          <div class="text-h4">Book With Extra Flexibility</div>
          <H3TBookFlexibility />
          <div class="text-h4">Your Travel, Your Tour</div>
          <H3TPrivateTourBlock />

          <div class="text-h4">Bình luận</div>
          <H3TTimeline :timeline="tour.reviews" />
        </v-col>
        <v-col cols="12" md="4"
          ><H3TCheckAvailability
            :duration="tour.range"
            :price_adult="tour.price.adult"
            :price_children="tour.price.child"
        /></v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  // @ is an alias to /src
  import { mapGetters } from 'vuex';
  import H3TCarousels from '@/components/Carousels.vue';
  import H3TTimeline from '@/components/Timeline.vue';
  import H3TBookFlexibility from '@/components/Tour/BookFlexibilityBlock.vue';
  import H3TPrivateTourBlock from '@/components/Tour/PrivateTourBlock.vue';
  import H3TCheckAvailability from '@/components/Tour/CheckAvailability.vue';

  import H3TTitle from '@/components/Tour/Title.vue';

  import H3TQuickFacts from '@/components/Tours/Card/quickFacts.vue';

  import { FETCH_TOUR } from '@/store/type/actions';
  import store from '@/store';

  export default {
    name: 'Tour',
    components: {
      H3TBookFlexibility,
      H3TPrivateTourBlock,
      H3TCarousels,
      H3TCheckAvailability,
      H3TTimeline,
      H3TQuickFacts,
      H3TTitle,
    },

    props: {
      id: {
        type: String,
        required: true,
      },
    },

    beforeRouteEnter(to, from, next) {
      Promise.all([store.dispatch(FETCH_TOUR, to.params.id)]).then(() => {
        next();
      });
    },

    computed: {
      ...mapGetters(['tour']),
    },
  };
</script>

<style scoped>
  .tourino-clip-path {
    clip-path: polygon(0 15%, 100% 0%, 100% 85%, 0% 100%);
  }

  .tourino-clip-path-bottom {
    clip-path: polygon(0 0, 100% 0%, 100% 75%, 0% 100%);
  }

  .tour-page {
    max-width: 800px;
  }
</style>
