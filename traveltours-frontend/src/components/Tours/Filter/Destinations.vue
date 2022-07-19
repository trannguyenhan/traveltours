<template>
  <v-autocomplete
    v-model="selection"
    clearable
    hide-details
    multiple
    :items="places"
    item-text="name"
    prepend-icon="mdi-map-marker-outline"
    label="Chọn nơi mà bạn muốn tới?"
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
        @click:close="removeFilterItem(item.name, selection)"
        >{{ item.name }}
      </v-chip>
    </template>

    <template #item="{ item }">
      <v-list-item-content>
        <span>{{ item.name }}</span>
      </v-list-item-content>
    </template>
  </v-autocomplete>
</template>

<script>
  import { FETCH_PLACES } from '@/store/type/actions.js';

  import getPredefinedOption from './mixins/getPredefinedOption';
  import syncSelectionWithUrl from './mixins/syncSelectionWithUrl';

  export default {
    mixins: [
      getPredefinedOption('places', FETCH_PLACES),
      syncSelectionWithUrl('places'),
    ],
    data: () => ({
      search: null,
    }),
  };
</script>

<style scoped></style>
