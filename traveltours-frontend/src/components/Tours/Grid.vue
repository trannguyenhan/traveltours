<template>
  <div>
    <TrnFilter />
    <div v-if="isToursLoading" class="text-center TrnLoading mb-3">
      <H3TLoadingAnimation />
    </div>
    <div v-else>
      <div v-if="returned === 0" class="text-center text-h5 TrnLoading">
        <H3TCompass style="font-size: 6em" />
        <br />
        Không có kết quả
        <br />
        Vui lòng xóa toàn bộ bộ lọc, tìm kiếm và tiến hành lại
      </div>
      <div v-else>
        <v-row align="center" justify="center">
          <v-col>
            <H3TSort class="pb-2 pt-0" />
          </v-col>

          <v-col class="text-center text-body-1 primary--text">
            Tìm thấy
            <span class="font-weight-medium secondary--text text--darken-1">{{
              tourQuantity
            }}</span>
            cho bạn
          </v-col>
          <v-col class="text-right">
            <H3TPagination
              v-if="total"
              no-button
              :length="pageQuantity"
              :returned="returned"
              :total="total"
            />
          </v-col>
        </v-row>

        <stack
          ref="stackRef"
          :column-min-width="320"
          :gutter-width="30"
          :gutter-height="40"
          :monitor-images-loaded="true"
        >
          <stack-item
            v-for="(tour, i) in tours"
            :key="i"
            style="transition: transform 1000ms"
            :class="$vuetify.breakpoint.xs ? 'TrnGridMobile' : ''"
          >
            <H3TCard :tour="tour" @reload-grid="reloadGrid" />
          </stack-item>
        </stack>

        <H3TPagination
          v-if="total"
          class="text-center"
          :length="pageQuantity"
          :returned="returned"
          :total="total"
        />
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex';
  import { FETCH_TOURS } from '@/store/type/actions';

  import H3TSort from '@/components/Tours/Sort.vue';
  import H3TFilter from '@/components/Tours/Filter/FilterTours.vue';
  import H3TPagination from '@/components/Tours/Pagination.vue';
  import H3TCard from '@/components/Tours/Card/Card.vue';
  import { Stack, StackItem } from 'vue-stack-grid';

  import H3TLoadingAnimation from '@/components/core/LoadingAnimation.vue';
  import H3TCompass from '@/components/base/Compass';

  import pluralize from '@/common/pluralize.js';
  import { APP_ITEMS_PER_PAGE } from '@/common/config.js';

  export default {
    components: {
      H3TSort,
      TrnFilter: H3TFilter,
      Stack,
      StackItem,
      H3TCard,
      H3TPagination,
      H3TLoadingAnimation,
      H3TCompass,
    },

    computed: {
      ...mapGetters(['isToursLoading', 'tours', 'total', 'returned']),
      tourQuantity() {
        return pluralize(this.total, 'tour');
      },
      pageQuantity() {
        return Math.ceil(this.total / APP_ITEMS_PER_PAGE);
      },
    },

    watch: {
      $route: {
        handler: 'fetchTours',
        immediate: true,
      },
    },

    methods: {
      reloadGrid() {
        this.$nextTick(() => {
          if (this.$refs.stackRef) this.$refs.stackRef.reflow();
        });
      },

      async fetchTours() {
        await this.$store.dispatch(FETCH_TOURS, this.$route.query);
      },
    },
  };
</script>

<style>
  .TrnLoading {
    /* margin-top: 1vh; */
    height: 500px;
  }
  .TrnGridMobile {
    max-width: 350px;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
  }

  .trn-no-border.v-text-field > .v-input__control > .v-input__slot:before {
    border-style: none;
  }
  .trn-no-border.v-text-field > .v-input__control > .v-input__slot:after {
    border-style: none;
  }
</style>
