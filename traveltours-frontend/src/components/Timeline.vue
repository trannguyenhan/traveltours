<template>
  <!-- :dense="$vuetify.breakpoint.mdAndDown" -->
  <v-timeline dense class="ml-n11 mr-10">
    <v-timeline-item
      v-for="(day, i) in timeline"
      :key="i"
      color="secondary"
      fill-dot
    >
      <template v-slot:icon>
        <span class="white--text">{{ i + 1 }}</span>
      </template>
      <BaseCard class="my-4 mx-auto">
        <div class="py-4">
          <v-card-title class="text-h6 primary--text text-capitalize">
            {{ capitalizeFristLetter(day.user.name) }}

            <v-rating
              v-model="day.star"
              readonly="1"
              icon-label="custom icon label text {0} of {1}"
            />
          </v-card-title>
          <v-card-text>
            <div style="white-space: pre-line; line-height: 1.6em">
              {{ day.comment }}
            </div>
          </v-card-text>
        </div>
      </BaseCard>
    </v-timeline-item>
  </v-timeline>
</template>

<script>
  import BaseCard from '../components/base/Card';

  export default {
    components: {
      BaseCard,
    },
    props: {
      timeline: {
        type: Array,
        required: true,
      },
    },
    methods: {
      splitedSummary(string) {
        return string.trim().split(/\. |\. |! /);
      },
      capitalizeFristLetter(string) {
        return string.toLowerCase();
      },
    },
  };
</script>

<style scoped>
  .trn-capital::first-letter {
    text-transform: uppercase;
  }
</style>
v
