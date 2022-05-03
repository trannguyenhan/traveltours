<template>
  <v-tooltip right color="primary lighten-1">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        class="TrnFloatingCallBtn"
        :href="`tel:${trimSpace}`"
        depressed
        fab
        fixed
        bottom
        left
        color="secondary"
        v-bind="attrs"
        v-on="on"
      >
        <v-icon>mdi-phone</v-icon>
      </v-btn>
    </template>
    <span class="text-h5">{{ phoneNo }}</span>
  </v-tooltip>
</template>

<script>
  export default {
    data: () => ({
      phoneNo: '024 5678 9999',
    }),
    computed: {
      trimSpace() {
        return this.phoneNo.replace(/\s/g, '');
      },
    },
  };
</script>

<style scoped></style>
