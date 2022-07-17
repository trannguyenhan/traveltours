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
          v-model="adults"
          :num="adults"
          v-on="$listeners"
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
          v-model="children"
          :num="children"
          v-on="$listeners"
          @changeValue="(value) => (children = value)"
        />
      </v-col>
    </v-row>
    <v-row class="justify-center">
      <v-btn class="btnBookTour" @click="bookTour">Book Tour</v-btn>
    </v-row>
    <v-dialog v-model="dialog" width="500">
      <v-card>
        <v-card-title class="text-h5 grey lighten-2"> Thông báo </v-card-title>

        <v-card-text>
          Bạn đã đặt tour thành công với mã đặt hàng {{ orderCode }}.
        </v-card-text>

        <v-divider />

        <v-card-actions>
          <v-spacer />
          <router-link to="/user/profile">
            <v-btn color="primary" text @click="dialog = false"> OK </v-btn>
          </router-link>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex';
  import pluralize from '@/common/pluralize.js';
  import orderApi from '@/common/service/order.api';
  import Swal from 'sweetalert2';
  import TrnPickNumber from './PickNumber';

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
      orderCode: 0,
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
      dialog: false,
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

        await orderApi
          .bookTour(this.data_send)
          .then((response) => {
            if (response.status === 200) {
              this.dialog = true;
              this.orderCode = response.data.data.id;
            } else if (response.status === 422) {
              Swal.fire({
                text: 'Bạn cần điền đầy đủ thông tin',
                icon: 'error',
              });
            }
          })
          .catch(() => {
            Swal.fire({
              text: 'Bạn chưa đăng nhập',
              icon: 'error',
            });
          });
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
