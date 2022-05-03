<template>
  <v-app>
    <H3TAlert />
    <H3THeader />
    <v-main>
      <H3TTransition>
        <router-view />
      </H3TTransition>
    </v-main>
    <H3TFooter />
    <H3TCallHotline />
    <H3TJumpTop />
  </v-app>
</template>

<script>
  import H3THeader from '@/components/core/Header/Header';
  import H3TAlert from '@/components/core/Alert.vue';
  import H3TCallHotline from '@/components/core/CallHotline';
  import H3TJumpTop from '@/components/core/JumpTop.vue';
  import H3TFooter from '@/components/core/Footer';

  export default {
    components: {
      H3THeader,
      H3TFooter,
      H3TCallHotline,
      H3TAlert,
      H3TJumpTop,
    },
  };
</script>

<style scoped>
  .v-card__text,
  .v-card__title {
    word-break: normal !important;
  }

  .v-application {
    background: linear-gradient(
        173deg,
        #29f8ff 0%,
        #f0feff 8%,
        #9aebffde 42%,
        #d5f4f6 50%,
        #c1ebf8 66%,
        #adf3ff 72%,
        #ddf4ff 83%,
        #65faff 100%
      )
      no-repeat center center fixed !important;
    background-size: cover !important;
  }
</style>
