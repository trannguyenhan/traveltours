<template>
  <v-row no-gutters>
    <v-icon style="font-size: 2em" class="primary--text"> mdi-hiking </v-icon>

    <v-col class="mx-5" align="center">
      <v-row v-if="!expand">
        <span
          v-for="index in Math.min(2, travelStyle.length)"
          :key="index"
          class="mr-3 mb-1"
        >
          <router-link
            style="text-decoration: none"
            :to="{
              name: 'Tours',
              query: { travelStyle: [travelStyle[index - 1]] },
            }"
          >
            {{ travelStyle[index - 1].name }}
          </router-link>
        </span>
        <span
          v-if="travelStyle.length - Math.min(2, travelStyle.length) > 0"
          class="text-caption secondary--text text--darken-2"
          @click="
            expand = true;
            $emit('reload-grid');
          "
        >
          +{{ travelStyle.length - 2 }} more
        </span>
      </v-row>

      <v-row v-if="expand">
        <span v-for="(style, j) in travelStyle" :key="j" class="mr-3 mb-1">
          <router-link
            style="text-decoration: none"
            :to="{
              name: 'Tours',
              query: { travelStyle: [style] },
            }"
          >
            {{ style.name }}
          </router-link>
        </span>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    props: {
      travelStyle: {
        type: Array,
        required: true,
      },
    },
    data: () => ({
      expand: false,
    }),
  };
</script>

<style scoped></style>
