<template>
  <div v-if="sale > 0" class="savingRibbon">
    <span class="savingValue white--text text-h6 text-center"
      >-{{ sale }}%</span
    >
  </div>
</template>

<script>
  export default {
    props: {
      price: {
        type: Number,
        required: true,
      },
      oldPrice: {
        type: Number,
        required: true,
      },
    },
    computed: {
      sale() {
        return Math.round((1 - this.price / this.oldPrice) * 100);
      },
    },
  };
</script>

<style scoped>
  .savingRibbon {
    /* border-top-color: transparent;
    border-left-color: rgb(255, 255, 255);
    border-bottom-color: transparent;
    border-right-color: transparent; */

    position: absolute;

    width: 0px;
    height: 0px;

    left: 0px;
    top: 0px;

    border-color: #0000 #0000 #0000 #ff6600;
    border-style: solid;
    border-width: 0px 0px 60px 60px;
  }

  .savingValue {
    position: relative;
    display: block;

    right: 65px;
    width: 60px;

    transform: rotate(315deg);
    padding-right: 0.9rem;
  }
</style>
