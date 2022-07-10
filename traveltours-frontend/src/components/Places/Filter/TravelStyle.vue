<template>
  <v-select
    v-model="selection"
    clearable
    hide-details
    multiple
    :items="travelStyle"
    item-text="value"
    prepend-icon="mdi-hiking"
    label="Travel Style"
    :loading="isOptionListLoading"
    no-data-text=""
    :class="{ 'trn-no-border': hasSelectionValue() }"
    @focus="getOptionList"
  >
    <template #selection="{ item }">
      <v-chip
        close
        color="primary"
        @click:close="removeFilterItem(item.value, selection)"
        >{{ item.value }}</v-chip
      >
    </template>

    <template #item="{ item }">
      <v-list-item-content>
        <span>{{ item.value }} - ( {{ item.count }} tours)</span>
      </v-list-item-content>
    </template>
  </v-select>
</template>

<script>
  import { FETCH_TRAVELSTYLE } from '@/store/type/actions.js';

  import getPredefinedOption from './mixins/getPredefinedOption';
  import syncSelectionWithUrl from './mixins/syncSelectionWithUrl';

  export default {
    mixins: [
      getPredefinedOption('travelStyle', FETCH_TRAVELSTYLE),
      syncSelectionWithUrl('travelStyle'),
    ],
  };
</script>

<style scoped></style>
