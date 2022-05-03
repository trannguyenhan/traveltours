<template>
  <v-select
    v-model="selection"
    item-text="label"
    :items="rating"
    prepend-icon="mdi-star-outline"
    label="Rating"
    hide-details
    :class="{ 'trn-no-border': hasSelectionValue() }"
  >
    <template #selection="{ item }">
      <v-chip color="primary" close @click:close="selection = ''">
        {{ item.label }}</v-chip
      >
    </template>
  </v-select>
</template>

<script>
  import syncSelectionWithUrl from './mixins/syncSelectionWithUrl';
  import { singleNumberSelection } from './mixins/selection';

  export default {
    mixins: [syncSelectionWithUrl('rating'), singleNumberSelection('rating')],
    data: () => ({
      rating: [
        { value: 5, label: '⭐⭐⭐⭐⭐' },
        { value: 4, label: '⭐⭐⭐⭐ and up' },
        { value: 3, label: '⭐⭐⭐ and up' },
        { value: 2, label: '⭐⭐ and up' },
      ],
    }),
  };
</script>

<style scoped></style>
