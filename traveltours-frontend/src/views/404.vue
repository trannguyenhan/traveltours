<template>
  <div class="text-center mt-10">
    <p
      :class="$vuetify.breakpoint.mdAndUp ? 'big-font' : 'text-h1'"
      class="font-weight-thin error--text"
    >
      4
      <TrnCompass />
      4
    </p>
    <p
      :class="$vuetify.breakpoint.mdAndUp ? 'text-h3' : 'text-h5'"
      class="mt-n6 font-weight-light primary--text"
    >
      looks like you got lost...
    </p>
    <v-btn large depressed class="mt-6" rounded color="error">
      <router-link
        style="text-decoration: none"
        class="white--text text-h6"
        :to="'/'"
      >
        go back HOME
      </router-link>
    </v-btn>
  </div>
</template>

<script>
  import TrnCompass from '@/components/base/Compass';

  export default {
    components: {
      TrnCompass,
    },
  };
</script>

<style scoped>
  .big-font {
    font-size: 12rem;
  }
</style>
