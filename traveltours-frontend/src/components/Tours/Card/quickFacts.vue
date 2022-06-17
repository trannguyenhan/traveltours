<template>
  <v-container class="px-4 mt-6 pb-0">
    <H3TRating
      class="mt-n8 pb-0"
      :rating="calcRating()"
      :reviews-quantity="calcRating(false)"
    />

    <H3THighlights
      class="py-1"
      :highlights="tour.dest.description"
      v-on="$listeners"
    />
    <H3TDestinations class="py-1" :destinations="tour.dest.address_detail" />

    <H3TTravelStyle
      class="py-1"
      :travel-style="tour.categories"
      v-on="$listeners"
    />
    <H3TDuration class="py-2" :duration="tour.range" />
    <H3TPrice :old-price="tour.price.adult + 10" :price="tour.price.adult" />
  </v-container>
</template>

<script>
  import H3TRating from './Rating.vue';
  import H3THighlights from './Highlights.vue';
  import H3TDestinations from './Destinations.vue';
  import H3TTravelStyle from './TravelStyle.vue';
  import H3TDuration from './Duration.vue';
  import H3TPrice from './Price.vue';

  export default {
    components: {
      H3TRating,
      H3THighlights,
      H3TDestinations,
      H3TTravelStyle,
      H3TDuration,
      H3TPrice,
    },

    props: {
      tour: {
        type: Object,
        required: true,
      },
    },

    methods: {
      calcRating(isRating = true) {
        let ratingAvg = 0;
        const { reviews } = this.tour;
        const numberReviews = reviews.length;
        for (let i = 0; i < reviews.length; i += 1) {
          const rating = reviews[i].star;
          ratingAvg += rating;
        }

        ratingAvg /= numberReviews;
        if (isRating) {
          return ratingAvg;
        }

        return numberReviews;
      },
    },
  };
</script>

<style scoped></style>
