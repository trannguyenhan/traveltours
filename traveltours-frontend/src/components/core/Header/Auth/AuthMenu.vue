<template>
  <v-menu
    v-model="menu"
    :transition="TRN_GLOBAL_TRANSITION"
    offset-y
    :close-on-content-click="false"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn outlined small fab color="secondary" v-bind="attrs" v-on="on">
        <v-icon large>mdi-account</v-icon>
      </v-btn>
    </template>
    <TrnAuthTab />
  </v-menu>
</template>

<script>
  import { APP_GLOBAL_TRANSITION } from '@/common/config.js';
  import TrnAuthTab from './AuthTab.vue';

  export default {
    components: {
      TrnAuthTab,
    },
    data: () => ({ menu: false, TRN_GLOBAL_TRANSITION: APP_GLOBAL_TRANSITION }),
  };
</script>

<style scoped>
  .v-toolbar__content,
  .v-toolbar__extension {
    padding: 0 !important;
  }
  .v-menu__content {
    color: #0000;
    top: 75px !important;
    max-width: 100%;
    box-shadow: none;
  }
</style>
