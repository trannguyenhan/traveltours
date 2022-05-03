<template>
  <div v-if="reviewsQuantity" style="width: 23%" class="text-center">
    <v-chip class="px-1" small color="secondary" text-color="white">
      <h3 class="px-1">{{ rating }}</h3>
      <v-icon color="white">mdi-star</v-icon>
    </v-chip>

    <div class="">
      <span class="text-caption">{{ pluralizedReviewsQuantity }}</span>
    </div>
  </div>
</template>

<script>
  import pluralize from '@/common/pluralize.js';

  export default {
    props: {
      rating: {
        type: Number,
        required: true,
      },
      reviewsQuantity: {
        type: Number,
        required: true,
      },
    },
    computed: {
      pluralizedReviewsQuantity() {
        return pluralize(this.reviewsQuantity, 'review');
      },
    },
  };
</script>

<style scoped></style>
