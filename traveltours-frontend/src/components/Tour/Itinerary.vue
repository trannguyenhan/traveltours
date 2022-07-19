<template>
  <v-timeline dense class="ml-n11 mr-10">
    <v-timeline-item
      v-for="(item, i) in timeline"
      :key="i"
      color="secondary"
      fill-dot
    >
      <template v-slot:icon>
        <span class="white--text">{{ i + 1 }}</span>
      </template>
      <BaseCard class="my-4 mx-auto">
        <div class="py-4">
          <router-link :to="{ path: '/place/' + item.id }">
            <v-card-title class="text-h6 primary--text text-capitalize">{{
              capitalizeFristLetter(item.address_detail)
            }}</v-card-title>
          </router-link>

          <v-card-text>
            <div style="white-space: pre-line; line-height: 1.6em">
              {{ item.description }}
            </div>
          </v-card-text>
        </div>
      </BaseCard>
    </v-timeline-item>
  </v-timeline>
</template>

<script>
  import BaseCard from '../base/Card';

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
        // eslint-disable-next-line no-irregular-whitespace
        return string.trim().split(/\. |\. |! /);
      },
      capitalizeFristLetter(string) {
        return string.toLowerCase();
      },
    },
  };
</script>

<style scoped></style>
