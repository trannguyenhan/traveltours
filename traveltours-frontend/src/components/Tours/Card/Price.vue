<template>
  <v-row no-gutters>
    <v-col>
      <TrnHeart class="ml-n2" />
    </v-col>

    <v-col cols="10">
      <TrnSkewText class="mt-n3 pr-2">
        <div class="text-h6 primary--text text--lighten-1 px-0">$</div>
        <div class="text-h4 primary--text text--lighten-1 pr-3">
          {{ priceFormatted(price) }}
        </div>

        <span
          v-if="oldPrice"
          class="strikeout text-h6 secondary--text text--darken-1 px-0"
        >
          ${{ priceFormatted(oldPrice) }}
        </span>
      </TrnSkewText>
    </v-col>
  </v-row>
</template>

<script>
  import TrnSkewText from '@/components/base/SkewText';
  import TrnHeart from './Heart';

  export default {
    components: {
      TrnHeart,
      TrnSkewText,
    },
    props: {
      price: {
        type: Number,
        required: true,
      },
      oldPrice: {
        type: Number,
        default: undefined,
      },
    },
    methods: {
      priceFormatted: (num) => num.toLocaleString(),
    },
  };
</script>

<style scoped>
  .strikeout {
    font-size: 4em;
    line-height: 1em;
    position: relative;
  }
  .strikeout::after {
    border-bottom: 0.15em solid #ff73006c;
    content: '';
    left: 0;
    /* margin-top: calc(0.125em / 2 * -1); */
    position: absolute;
    right: 0;
    top: 45%;
  }
</style>
