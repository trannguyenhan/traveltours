<template>
  <v-btn
    v-show="fab"
    v-scroll="onScroll"
    fab
    dark
    fixed
    bottom
    right
    color="secondary"
    @click="toTop"
  >
    <v-icon>mdi-rocket</v-icon>
  </v-btn>
</template>

<script>
  export default {
    data: () => ({
      fab: false,
    }),

    methods: {
      onScroll() {
        if (typeof window === 'undefined') return;
        const top = window.pageYOffset || 0; // e.target.scrollTop
        this.fab = top > 350;
      },
      toTop() {
        this.$vuetify.goTo(0);
      },
    },
  };
</script>

<style scoped></style>
