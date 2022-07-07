<template>
  <div>
    <v-row align="center" justify="center">
      <v-col cols="6">
        <TrnDestinations />
      </v-col>

      <v-col cols="6">
        <TrnTravelStyle />
      </v-col>
    </v-row>

    <v-row class="mt-1" justify="center">
      <v-col cols="6" align="center">
        <TrnPrice />
      </v-col>

      <v-col cols="3">
        <TrnRating />
      </v-col>

      <v-col cols="3">
        <TrnDuration />
      </v-col>
    </v-row>
  </div>
</template>

<script>
  import TrnDestinations from './Destinations';
  import TrnTravelStyle from './TravelStyle';
  import TrnPrice from './Price';
  import TrnRating from './Rating';
  import TrnDuration from './Duration';

  export default {
    components: {
      TrnDestinations,
      TrnTravelStyle,
      TrnPrice,
      TrnRating,
      TrnDuration,
    },
  };
</script>

<style scoped></style>
