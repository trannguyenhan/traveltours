<template>
  <div
    class="TrnAlert"
    :class="$vuetify.breakpoint.mobile ? 'TrnAlertMobile' : 'TrnAlertDesktop'"
  >
    <v-alert
      :value="!!getError.message"
      :type="getError.type"
      :transition="H3T_GLOBAL_TRANSITION"
      :dismissible="$vuetify.breakpoint.mdAndUp"
      dense
      :prominent="$vuetify.breakpoint.mdAndUp"
      class="rounded-tr-xl rounded-bl-xl text-center text-caption text-md-body-1"
      min-width="400px"
      @input="[CLEAR_ERROR]"
    >
      {{ getError.message }}
    </v-alert>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';
  import { APP_GLOBAL_TRANSITION } from '@/common/config.js';
  import { CLEAR_ERROR } from '@/store/type/actions';

  export default {
    data: () => ({
      H3T_GLOBAL_TRANSITION: APP_GLOBAL_TRANSITION,
    }),
    computed: {
      ...mapGetters(['getError']),
    },

    methods: {
      ...mapActions([CLEAR_ERROR]),
    },
  };
</script>

<style scoped>
  .TrnAlert {
    position: fixed;
    left: 50%;

    z-index: 4;
    transform: translate(-50%);
  }
  .TrnAlertMobile {
    bottom: 0%;
  }

  .TrnAlertDesktop {
    top: 0%;
  }
</style>
