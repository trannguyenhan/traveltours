<template>
  <div>
    <v-row align="center" class="text-body-2">
      <v-col>
        <span>{{ adultsQuantity }}</span>
      </v-col>
      <v-col>
        <span class="pr-2">x</span>
        <span class="secondary--text text--darken-1">${{ price_adult }}</span>
      </v-col>
      <v-col>
        <TrnPickNumber
          ref="adults"
          v-on="$listeners"
          :num="adults"
          @changeValue="(value) => (adults = value)"
        />
      </v-col>
    </v-row>

    <v-row align="center" class="text-body-2">
      <v-col>
        <span>{{ childrenQuantity }}</span>
      </v-col>

      <v-col>
        <span class="pr-2">x</span>
        <span class="secondary--text text--darken-1">
          ${{ price_children }}</span
        >
      </v-col>
      <v-col>
        <TrnPickNumber
          ref="childrens"
          v-on="$listeners"
          :num="children"
          @changeValue="(value) => (children = value)"
        />
      </v-col>
    </v-row>
    <v-row class="justify-center">
      <v-btn class="btnBookTour" @click="bookTour">Book Tour</v-btn>
    </v-row>
  </div>
</template>

<script>
  import pluralize from '@/common/pluralize.js';
  import orderApi from '@/common/service/order.api';
  import TrnPickNumber from './PickNumber';
  import { mapGetters } from "vuex";

  export default {
    components: {
      TrnPickNumber,
    },
    props: {
      price_adult: {
        type: Number,
        required: true,
      },
      price_children: {
        type: Number,
        required: true,
      },
    },
    data: () => ({
      adults: 1,
      children: 0,
      data_send: {
        tour_id: 1,
        user_id: 1,
        child_count: 0,
        adult_count: 0,
        total_price: 0,
        tax: 10,
        payment_method: 'cod',
        status: 'ok',
      },
    }),
    computed: {
      adultsQuantity() {
        return pluralize(this.adults, 'Adult');
      },
      childrenQuantity() {
        return pluralize(this.children, 'Child', 'Children');
      },
      ...mapGetters(['currentUser']),
    },
    methods: {
      totalPrice(count1, price1, count2, price2) {
        return count1 * price1 + count2 * price2;
      },
      async bookTour() {
        this.data_send = {
          ...this.data_send,
          tour_id: this.$route.params.id,
          user_id: this.currentUser.id,
          child_count: this.children,
          adult_count: this.adults,
          total_price: this.totalPrice(
            this.children,
            this.price_children,
            this.adults,
            this.price_adult
          ),
        };
        const resp = orderApi.bookTour(this.data_send);
        console.log(resp);
      },
    },
  };
</script>

<style scoped>
  .btnBookTour {
    background-color: #ff9800 !important;
    color: #ffffff;
    border-radius: 4px;
    margin: 10px 0;
  }
</style>
