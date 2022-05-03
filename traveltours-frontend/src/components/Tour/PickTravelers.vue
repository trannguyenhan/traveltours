<template>
  <div>
    <v-row align="center" class="text-body-2">
      <v-col>
        <span>{{ adultsQuantity }}</span>
      </v-col>
      <v-col>
        <span class="pr-2">x</span>
        <span class="secondary--text text--darken-1">${{ price }}</span>
      </v-col>
      <v-col>
        <TrnPickNumber ref="adults" v-on="$listeners" />
      </v-col>
    </v-row>

    <v-row align="center" class="text-body-2">
      <v-col>
        <span>{{ childrenQuantity }}</span>
      </v-col>

      <v-col>
        <span class="pr-2">x</span>
        <span class="secondary--text text--darken-1">${{ price }}</span>
        <span class="px-2">x</span>
        <span>75%</span>
      </v-col>
      <v-col>
        <TrnPickNumber ref="childrens" v-on="$listeners" />
      </v-col>
    </v-row>

    <v-row align="center" class="text-body-2">
      <v-col>
        <span>{{ infantsQuantity }}</span>
      </v-col>
      <v-col>
        <span class="pr-2">x</span>
        <span class="secondary--text text--darken-1">${{ price }}</span>
        <span class="px-2">x</span>
        <span>0%</span>
      </v-col>
      <v-col>
        <TrnPickNumber ref="infants" v-on="$listeners" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
  import pluralize from '@/common/pluralize.js';
  import TrnPickNumber from './PickNumber';

  export default {
    components: {
      TrnPickNumber,
    },
    props: {
      price: {
        type: Number,
        required: true,
      },
    },
    data: () => ({
      adults: 1,
      children: 0,
      infants: 0,
    }),
    computed: {
      adultsQuantity() {
        return pluralize(this.adults, 'Adult');
      },
      childrenQuantity() {
        return pluralize(this.children, 'Child', 'Children');
      },
      infantsQuantity() {
        return pluralize(this.infants, 'Infant');
      },
    },
  };
</script>

<style scoped></style>
