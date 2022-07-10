<template>
  <v-row no-gutters>
    <v-icon style="font-size: 2em" class="primary--text pr-2"
      >mdi-map-marker-outline</v-icon
    >

    <v-col>
      <router-link
        style="text-decoration: none"
        :to="{ name: 'Tours', query: { destinations: [destinations] } }"
      >
        {{ destinations }}
      </router-link>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    props: {
      destinations: {
        type: String,
        required: true,
      },
    },
  };
</script>

<style scoped></style>
