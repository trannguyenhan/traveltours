<template>
  <div style="max-width: 1200px; margin: auto" class="primary--text">
    <v-row class="mt-4">
      <v-col cols="12" md="8">
        <div style="position: relative">
          <H3TCarousels :items="place.images" />
        </div>
      </v-col>

      <v-col cols="12" md="4">
        <H3TTitle class="text-h4">{{ place.name }}</H3TTitle>

        <H3TQuickFacts
          :place="place"
          style="font-size: 16px"
          v-on="$listeners"
        />
      </v-col>
    </v-row>

    <v-container class="mt-6">
      <v-row>
        <v-col cols="12" md="8">
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
          <H3TTimeline :timeline="place.reviews" />
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
  import H3TTitle from '@/components/Tour/Title.vue';

  import H3TQuickFacts from '@/components/Places/Card/quickFacts.vue';

  import { FETCH_PLACE } from '@/store/type/actions';
  import store from '@/store';
  import reviewApi from '@/common/service/review.api';

  export default {
    name: 'Place',
    components: {
      H3TCarousels,
      H3TTimeline,
      H3TQuickFacts,
      H3TTitle,
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
        type: 'place',
      },
    }),

    beforeRouteEnter(to, from, next) {
      Promise.all([store.dispatch(FETCH_PLACE, to.params.id)]).then(() => {
        next();
      });
    },

    computed: {
      ...mapGetters(['place', 'currentUser']),
    },
    methods: {
      checkAuth() {
        try {
          if (this.currentUser.id > 0) {
            this.dialog1 = true;
          }
        } catch (e) {
          alert('Bạn chưa đăng nhập');
        }
      },
      reloadPage() {
        window.location.reload();
      },
      async submitComment() {
        try {
          this.data_comment = {
            ...this.data_comment,
            comment: this.comment,
            object_id: this.$route.params.id,
            user_id: this.currentUser.id,
            star: this.rating,
          };
          const resp = await reviewApi.submitComment(this.data_comment);
          if (resp.status === 200) {
            this.dialog1 = false;
            this.reloadPage();
          }
        } catch (e) {
          alert("Vui lòng load lại trang");
        }
      },
    },
  };
</script>

<style scoped>
  .tourino-clip-path {
    clip-path: polygon(0 15%, 100% 0%, 100% 85%, 0% 100%);
  }

  .tourino-clip-path-bottom {
    clip-path: polygon(0 0, 100% 0%, 100% 75%, 0% 100%);
  }

  .tour-page {
    max-width: 800px;
  }

  .btnComment {
    background-color: #ff9800 !important;
    color: #ffffff;
    border-radius: 4px;
    margin: 10px 0;
  }
</style>
