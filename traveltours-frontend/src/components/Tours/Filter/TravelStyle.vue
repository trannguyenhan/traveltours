<template>
  <v-select
    v-model="selection"
    clearable
    hide-details
    multiple
    :items="categories"
    item-text="name"
    prepend-icon="mdi-hiking"
    label="Loại hình du lịch"
    :loading="isOptionListLoading"
    no-data-text=""
    :class="{ 'trn-no-border': hasSelectionValue() }"
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
  </v-select>
</template>

<script>
  import { FETCH_CATEGORIES } from '@/store/type/actions.js';

  import getPredefinedOption from './mixins/getPredefinedOption';
  import syncSelectionWithUrl from './mixins/syncSelectionWithUrl';

  export default {
    mixins: [
      getPredefinedOption('categories', FETCH_CATEGORIES),
      syncSelectionWithUrl('categories'),
    ],
  };
</script>

<style scoped></style>
