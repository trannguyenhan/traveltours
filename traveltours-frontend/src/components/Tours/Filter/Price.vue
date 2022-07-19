<template>
  <div>
    <span class="subtitle-1 grey--text text--darken-2 pl-2">Giá tiền</span>
    <v-range-slider
      prepend-icon="mdi-cash-usd-outline"
      :value="selection"
      hide-details
      :max="max"
      :min="min"
      step="50"
      :thumb-size="38"
      thumb-label="always"
      @change="selection = $event"
    >
      >
      <template #thumb-label="props">
        {{ sliderValue(props.value) }}
      </template>
    </v-range-slider>
  </div>
</template>

<script>
  import { APP_FILTER_MAX_PRICE } from '@/common/config.js';
  // import syncPriceWithUrl from './mixins/syncPriceWithUrl';

  import syncSelectionWithUrl from './mixins/syncSelectionWithUrl';
  import { multipleSelection, defaultSelection } from './mixins/selection';

  export default {
    mixins: [
      syncSelectionWithUrl('price'),
      multipleSelection('price'),
      defaultSelection('price'), // need to put in last to override method hasSelectionValue()
    ],
    data: () => ({
      min: 0,
      max: APP_FILTER_MAX_PRICE,
      selection: [0, APP_FILTER_MAX_PRICE],
      defaultSelection: [0, APP_FILTER_MAX_PRICE],
    }),

    methods: {
      sliderValue(value) {
        return value === APP_FILTER_MAX_PRICE ? 'MAX' : `$${value.toString()}`;
      },
    },
  };
</script>

<style scoped></style>
