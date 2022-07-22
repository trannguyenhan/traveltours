<template>
  <div>
    <v-row align="center">
      <H3TSearch />
    </v-row>
    <v-row align="center" justify="center">
      <v-col cols="6">
        <H3TDestinations />
      </v-col>

      <v-col cols="6">
        <H3TTravelStyle />
      </v-col>
    </v-row>

    <v-row class="mt-1" justify="center">
      <v-col cols="6" align="center">
        <H3TPrice />
      </v-col>

      <v-col cols="3">
        <H3TRating />
      </v-col>

      <v-col cols="3">
        <H3TDuration />
      </v-col>
    </v-row>
  </div>
</template>

<script>
  import H3TSearch from './SearchTours';
  import H3TDestinations from './Destinations';
  import H3TTravelStyle from './TravelStyle';
  import H3TPrice from './Price';
  import H3TRating from './Rating';
  import H3TDuration from './Duration';

  export default {
    components: {
      H3TSearch,
      H3TDestinations,
      H3TTravelStyle,
      H3TPrice,
      H3TRating,
      H3TDuration,
    },
  };
</script>

<style scoped></style>
