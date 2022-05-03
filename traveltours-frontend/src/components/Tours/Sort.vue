<template>
  <v-select
    v-model="selection"
    style="width: 250px"
    :items="sortBy"
    clearable
    label="Sort By"
    :menu-props="{ maxHeight: 400 }"
    class="trn-no-border text-center"
    hide-details
  >
    <template #selection="{ item }">
      <!-- <v-chip  color="primary"> -->
      <v-icon class="pr-2">{{ item.prependIcon }}</v-icon> {{ item.label
      }}<v-icon right>{{ item.appendIcon }}</v-icon>
      <!-- </v-chip> -->
    </template>

    <template #item="{ item }">
      <v-list-item-content>
        <span
          ><v-icon left>{{ item.prependIcon }}</v-icon> {{ item.label
          }}<v-icon right>{{ item.appendIcon }}</v-icon></span
        >
      </v-list-item-content>
    </template>
  </v-select>
</template>

<script>
  import syncSelectionWithUrl from './Filter/mixins/syncSelectionWithUrl';
  import { singleStringSelection } from './Filter/mixins/selection';

  export default {
    mixins: [syncSelectionWithUrl('sort'), singleStringSelection('sort')],
    data: () => ({
      sortBy: [
        {
          value: 'price',
          label: 'Price',
          appendIcon: 'mdi-arrow-up',
          prependIcon: 'mdi-cash-usd-outline',
        },
        {
          value: '-price',
          label: 'Price',
          appendIcon: 'mdi-arrow-down',
          prependIcon: 'mdi-cash-usd-outline',
        },
        {
          value: '-rating',
          label: 'Rating',
          appendIcon: '',
          prependIcon: 'mdi-star-outline',
        },
        {
          value: '-reviewsQuantity',
          label: 'Reviews',
          appendIcon: '',
          prependIcon: 'mdi-account-check-outline',
        },
        {
          value: '-createAt',
          label: 'New on Tourino',
          appendIcon: '',
          prependIcon: 'mdi-clock-check-outline',
        },
        {
          value: '-duration',
          label: 'Duration',
          appendIcon: 'mdi-arrow-down',
          prependIcon: 'mdi-calendar-clock',
        },
        {
          value: 'duration',
          label: 'Duration',
          appendIcon: 'mdi-arrow-up',
          prependIcon: 'mdi-calendar-clock',
        },
      ],
    }),
  };
</script>

<style scoped></style>
