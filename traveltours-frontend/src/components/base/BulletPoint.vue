<template>
  <v-row align="center">
    <div class="secondary circle d-flex align-center justify-center">
      <v-icon style="font-size: 2em" class="white--text">{{ icon }}</v-icon>
    </div>
    <v-col>
      <div class="font-weight-medium">{{ title }}</div>
      <div>{{ content }}</div>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    props: {
      icon: {
        type: String,
        required: true,
      },
      title: {
        type: String,
        required: true,
      },
      content: {
        type: String,
        required: true,
      },
    },
  };
</script>

<style scoped>
  .circle {
    height: 50px;
    width: 50px;
    border-radius: 50%;
    /* display: inline-block; */
  }
</style>
