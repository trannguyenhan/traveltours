<template>
  <v-autocomplete
    v-model="selection"
    clearable
    hide-details
    multiple
    :items="destinations"
    item-text="value"
    prepend-icon="mdi-map-marker-outline"
    label="What places do you want to travel?"
    :search-input.sync="search"
    :loading="isOptionListLoading"
    no-data-text=""
    :class="{ 'trn-no-border': hasSelectionValue() }"
    @change="search = ''"
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
  </v-autocomplete>
</template>

<script>
  import { FETCH_DESTINATIONS } from '@/store/type/actions.js';

  import getPredefinedOption from './mixins/getPredefinedOption';
  import syncSelectionWithUrl from './mixins/syncSelectionWithUrl';

  export default {
    mixins: [
      getPredefinedOption('destinations', FETCH_DESTINATIONS),
      syncSelectionWithUrl('destinations'),
    ],
    data: () => ({
      search: null,
    }),
  };
</script>

<style scoped></style>
