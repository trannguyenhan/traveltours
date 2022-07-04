<template>
  <div class="text-center sticky">
    <TrnCard class="px-4">
      <v-card-title>Select Date and Travelers</v-card-title>

      <v-date-picker
        v-model="computedRangeByStartDate"
        range
        no-title
        scrollable
        color="secondary"
        :min="minimumAllowedDate"
        :max="maximumAllowedDate"
      />
      <div class="text-body-2">You can book this tour any day</div>
      <div class="text-body-2">
        from
        <span class="font-weight-medium secondary--text text--darken-1">{{
          getDateString(minimumAllowedDate)
        }}</span>
        to
        <span class="font-weight-medium secondary--text text--darken-1">{{
          getDateString(maximumAllowedDate)
        }}</span>
      </div>
      <v-row>
        <v-col>
          <v-menu
            v-model="menuPickStartDate"
            :close-on-content-click="true"
            transition="scale-transition"
            offset-y
            min-width="290px"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                :value="getDateString(range[0])"
                label="Start Date"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                clearable
                v-on="on"
              />
            </template>
            <v-date-picker
              v-model="computedRangeByStartDate"
              range
              no-title
              scrollable
              color="secondary"
              :min="minimumAllowedDate"
              :max="maximumAllowedDate"
            />
          </v-menu>
        </v-col>
        <v-col>
          <v-menu
            v-model="menuPickFinishDate"
            :close-on-content-click="true"
            transition="scale-transition"
            offset-y
            min-width="290px"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                :value="getDateString(range[1])"
                label="Finish Date"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                clearable
                v-on="on"
              />
            </template>
            <v-date-picker
              v-model="computedRangeByFinishDate"
              range
              no-title
              scrollable
              color="secondary"
              :min="minimumAllowedDate"
              :max="maximumAllowedDate"
            />
          </v-menu>
        </v-col>
      </v-row>
      <TrnPickTravelers v-bind="$attrs" />
    </TrnCard>
  </div>
</template>

<script>
  import {
    APP_MINIMUM_ALLOWED_BOOKING_DATE,
    APP_MAXIMUM_ALLOWED_BOOKING_DATE,
  } from '@/common/config.js';

  import TrnCard from '@/components/base/Card.vue';
  import TrnPickTravelers from './PickTravelers';

  export default {
    components: {
      TrnCard,
      TrnPickTravelers,
    },
    props: {
      duration: {
        type: Number,
        required: true,
      },
    },
    data: () => ({
      range: [],
      menuPickStartDate: false,
      menuPickFinishDate: false,
      TRN_MAXIMUM_ALLOWED_BOOKING_DATE: APP_MAXIMUM_ALLOWED_BOOKING_DATE,
      TRN_MINIMUM_ALLOWED_BOOKING_DATE: APP_MINIMUM_ALLOWED_BOOKING_DATE,
    }),
    computed: {
      minimumAllowedDate() {
        return this.addDays(
          new Date(Date.now()),
          APP_MINIMUM_ALLOWED_BOOKING_DATE
        );
      },
      maximumAllowedDate() {
        return this.addDays(
          new Date(Date.now()),
          APP_MAXIMUM_ALLOWED_BOOKING_DATE
        );
      },
      computedRangeByStartDate: {
        get() {
          return this.range;
        },
        set([firstDay]) {
          const lastDay = this.addDays(firstDay, this.duration - 1);
          this.range = [firstDay, lastDay];
        },
      },
      computedRangeByFinishDate: {
        get() {
          return this.range;
        },
        set([lastDay]) {
          const firstDay = this.addDays(lastDay, -this.duration + 1);
          this.range = [firstDay, lastDay];
        },
      },
    },
    created() {
      this.range = [
        this.minimumAllowedDate,
        this.addDays(this.minimumAllowedDate, this.duration - 1),
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
