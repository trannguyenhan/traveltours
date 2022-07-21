<template>
  <v-select
    v-model="selection"
    style="width: 250px"
    :items="sortBy"
    clearable
    label="Sắp xếp theo"
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
          label: 'Giá tiền',
          appendIcon: 'mdi-arrow-up',
          prependIcon: 'mdi-cash-usd-outline',
        },
        {
          value: '-price',
          label: 'Giá tiền',
          appendIcon: 'mdi-arrow-down',
          prependIcon: 'mdi-cash-usd-outline',
        },
        {
          value: '-rating',
          label: 'Đánh giá',
          appendIcon: '',
          prependIcon: 'mdi-star-outline',
        },
        {
          value: '-createAt',
          label: 'Tour mới nhất',
          appendIcon: '',
          prependIcon: 'mdi-clock-check-outline',
        },
        {
          value: '-duration',
          label: 'Thời gian chuyến đi',
          appendIcon: 'mdi-arrow-down',
          prependIcon: 'mdi-calendar-clock',
        },
        {
          value: 'duration',
          label: 'Thời gian chuyến đi',
          appendIcon: 'mdi-arrow-up',
          prependIcon: 'mdi-calendar-clock',
        },
      ],
    }),
  };
</script>

<style scoped></style>
