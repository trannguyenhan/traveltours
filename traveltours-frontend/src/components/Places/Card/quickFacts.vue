<template>
  <v-container class="px-4 mt-6 pb-0">
    <H3TRating
      class="mt-n8 pb-0"
      :rating="calcRating()"
      :reviews-quantity="calcRating(false)"
    />

    <H3THighlights
      class="py-1"
      :highlights="place.description"
      v-on="$listeners"
    />
    <H3TDestinations class="py-1" :destinations="place.address_detail" />
  </v-container>
</template>

<script>
  import H3TRating from './Rating.vue';
  import H3THighlights from './Highlights.vue';
  import H3TDestinations from './Destinations.vue';

  export default {
    components: {
      H3TRating,
      H3THighlights,
      H3TDestinations,
    },

    props: {
      place: {
        type: Object,
        required: true,
      },
    },

    methods: {
      calcRating(isRating = true) {
        let ratingAvg = 0;
        const { reviews } = this.place;
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
