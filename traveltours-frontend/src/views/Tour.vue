<template>
  <div style="max-width: 1200px; margin: auto" class="primary--text">
    <v-row class="mt-4">
      <v-col cols="12" md="8">
        <div style="position: relative">
          <H3TCarousels :items="tour.dest.images" />
        </div>
      </v-col>

      <v-col cols="12" md="4">
        <H3TTitle class="text-h4">{{ tour.dest.name }}</H3TTitle>

        <H3TQuickFacts :tour="tour" style="font-size: 16px" v-on="$listeners" />
      </v-col>
    </v-row>

    <v-container class="mt-6">
      <v-row>
        <v-col cols="12" md="8">
          <div class="text-h4">Tại sao bạn chọn H3T?</div>
          <H3TBookFlexibility />

          <div class="text-h4">Thông tin về tour</div>
          <H3TPrivateTourBlock :item="tour" />

          <div class="text-h4">Lịch trình</div>
          <H3TItinerary :timeline="tour.places_detail" />

          <v-row class="justify-center">
            <v-btn class="text-h5 justify-center btnComment" @click="checkAuth"
              >Comment</v-btn
            >
          </v-row>
          <div class="text-center">
            <v-dialog v-model="dialog1" width="500">
              <v-form v-model="valid">
                <v-card>
                  <v-card-title class="text-h5 grey lighten-2">
                    Comment
                  </v-card-title>
                  <v-rating
                    v-model="rating"
                    background-color="purple lighten-3"
                    color="purple"
                    large
                  />
                  <v-text-field
                    v-model="comment"
                    label="Đánh giá của bạn"
                    :rules="rules"
                    hide-details="auto"
                    style="width: 95%; margin: auto"
                  />

                  <v-divider />

                  <v-card-actions>
                    <v-spacer />
                    <v-btn color="primary" text @click="submitComment">
                      Comment
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-form>
            </v-dialog>
          </div>

          <div class="text-h4">Comment</div>
          <H3TTimeline :timeline="tour.reviews" />
        </v-col>
        <v-col cols="12" md="4">
          <H3TCheckAvailability
            :start-date="
              new Date(tour.start_date).toISOString().substring(0, 10)
            "
            :range="tour.range"
            :price_adult="tour.price.adult"
            :price_children="tour.price.child"
          />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  // @ is an alias to /src
  import { mapGetters } from 'vuex';
  import H3TCarousels from '@/components/Carousels.vue';
  import H3TTimeline from '@/components/Timeline.vue';
  import H3TBookFlexibility from '@/components/Tour/BookFlexibilityBlock.vue';
  import H3TPrivateTourBlock from '@/components/Tour/PrivateTourBlock.vue';
  import H3TCheckAvailability from '@/components/Tour/CheckAvailability.vue';
  import H3TItinerary from '@/components/Tour/Itinerary';

  import H3TTitle from '@/components/Tour/Title.vue';

  import H3TQuickFacts from '@/components/Tours/Card/quickFacts.vue';

  import { FETCH_TOUR } from '@/store/type/actions';
  import store from '@/store';
  import reviewApi from '@/common/service/review.api';
  import orderApi from '@/common/service/order.api';
  import Swal from 'sweetalert2';

  export default {
    name: 'Tour',
    components: {
      H3TBookFlexibility,
      H3TPrivateTourBlock,
      H3TCarousels,
      H3TCheckAvailability,
      H3TTimeline,
      H3TQuickFacts,
      H3TTitle,
      H3TItinerary,
    },

    props: {
      id: {
        type: String,
        required: true,
      },
    },

    data: () => ({
      dialog1: false,
      rating: 4,
      valid: false,
      comment: '',
      rules: [
        (value) => !!value || 'Required.',
        (value) => (value && value.length >= 3) || 'Min 3 characters',
      ],
      data_comment: {
        type: 'tour',
      },
    }),

    beforeRouteEnter(to, from, next) {
      Promise.all([store.dispatch(FETCH_TOUR, to.params.id)]).then(() => {
        next();
      });
    },

    computed: {
      ...mapGetters(['tour', 'currentUser']),
    },
    methods: {
      async fetchTours() {
        await this.$store.dispatch(FETCH_TOUR, this.tour.id);
      },
      async checkAuth() {
        try {
          await orderApi
            .checkBookTour(this.tour.id, this.currentUser.id)
            .then((response) => {
              if (response.status === 200) {
                if (response.data.message) {
                  this.dialog1 = true;
                } else {
                  Swal.fire({
                    text: 'Bạn chưa đặt tour này nên không thể đánh giá!',
                    icon: 'error',
                  });
                }
              }
            });
        } catch (e) {
          if (this.currentUser == null) {
            await Swal.fire({
              text: 'Bạn chưa đăng nhập',
              icon: 'error',
            });
          } else {
            await Swal.fire({
              text: 'Đã có lỗi xảy ra. Vui lòng thử lại',
              icon: 'error',
            });
          }
        }
      },
      async submitComment() {
        this.data_comment = {
          ...this.data_comment,
          comment: this.comment,
          object_id: this.tour.id,
          user_id: this.currentUser.id,
          star: this.rating,
        };
        const resp = await reviewApi.submitComment(this.data_comment);
        if (resp.status === 200) {
          this.dialog1 = false;
          await this.fetchTours();
        }
      },
    },
  };
</script>

<style scoped>
  .btnComment {
    background-color: #ff9800 !important;
    color: #ffffff;
    border-radius: 4px;
    margin: 10px 0;
  }
</style>
