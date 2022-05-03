<template>
  <div>
    <div class="text-body-1 primary--text">
      Trang:
      <span class="font-weight-medium secondary--text text--darken-1">{{
        selection
      }}</span>
      | Tours:
      <span class="font-weight-medium secondary--text text--darken-1">{{
        tourStart
      }}</span>
      <span
        v-if="tourStart !== tourEnd"
        class="font-weight-medium secondary--text text--darken-1"
      >
        - {{ tourEnd }}</span
      >
      của
      <span class="font-weight-medium secondary--text text--darken-1">{{
        total
      }}</span>
    </div>
    <v-pagination
      v-if="!noButton"
      v-model="selection"
      :total-visible="visible"
      :length="length"
      class="mb-4 pt-2"
    />
  </div>
</template>

<script>
  import { APP_ITEMS_PER_PAGE } from '@/common/config.js';

  import syncSelectionWithUrl from './Filter/mixins/syncSelectionWithUrl';
  import {
    singleNumberSelection,
    defaultSelection,
  } from './Filter/mixins/selection';

  export default {
    mixins: [
      syncSelectionWithUrl('page'),
      singleNumberSelection('page'),
      defaultSelection('page'), // need to put in last to override method hasSelectionValue()
    ],

    props: {
      noButton: {
        type: Boolean,
      },
      length: {
        type: Number,
        required: true,
      },
      returned: {
        type: Number,
        required: true,
      },
      total: {
        type: Number,
        required: true,
      },
    },

    data: () => ({
      selection: 1,
      defaultSelection: 1,
      visible: 12,
    }),

    computed: {
      tourEnd() {
        return this.tourStart + this.returned - 1;
      },
      tourStart() {
        return (this.selection - 1) * APP_ITEMS_PER_PAGE + 1;
      },
    },
  };
</script>
