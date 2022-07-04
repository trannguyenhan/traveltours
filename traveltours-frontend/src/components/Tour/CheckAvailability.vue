<template>
  <div class="text-center sticky">
    <TrnCard class="px-4">
      <v-card-title>Time of trip</v-card-title>

      <v-date-picker
        v-model="computedRangeByStartDate"
        range
        no-title
        scrollable
        color="secondary"
        readonly
      />
      <br />
      <br />
      <div class="text-body-2">Time of trip range</div>
      <div class="text-body-2">
        from
        <span class="font-weight-medium secondary--text text--darken-1">{{
          getDateString(new Date(this.startDate))
        }}</span>
        to
        <span class="font-weight-medium secondary--text text--darken-1">{{
          getDateString(new Date(this.addDays(this.startDate, this.range)))
        }}</span>
      </div>
      <br />
      <TrnPickTravelers v-bind="$attrs" />
    </TrnCard>
  </div>
</template>

<script>
  import TrnCard from '@/components/base/Card.vue';
  import TrnPickTravelers from './PickTravelers';

  export default {
    components: {
      TrnCard,
      TrnPickTravelers,
    },
    props: {
      range: {
        type: Number,
        required: true,
      },
      startDate: {
        type: String,
        required: true,
      },
    },
    data: () => ({
      timeRange: [],
      menuPickStartDate: false,
      menuPickFinishDate: false,
    }),
    computed: {
      computedRangeByStartDate: {
        get() {
          return this.timeRange;
        },
        set([firstDay]) {
          const lastDay = this.addDays(firstDay, this.range - 1);
          this.timeRange = [firstDay, lastDay];
        },
      },
      computedRangeByFinishDate: {
        get() {
          return this.timeRange;
        },
        set([lastDay]) {
          const firstDay = this.addDays(lastDay, -this.range + 1);
          this.timeRange = [firstDay, lastDay];
        },
      },
    },
    created() {
      this.timeRange = [
        this.startDate,
        this.addDays(this.startDate, this.range - 1),
      ];
    },
    methods: {
      addDays: (date, days) =>
        new Date(new Date(date).setDate(new Date(date).getDate() + days))
          .toISOString()
          .substring(0, 10),
      getDateString: (date) => new Date(date).toDateString(),
    },
  };
</script>

<style scoped>
  .sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 2em;
  }
</style>
