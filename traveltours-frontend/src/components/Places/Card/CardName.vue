<template>
  <H3TSkewText
    background
    class="card-name"
    :class="
      name.length > 100
        ? 'greater-than-100'
        : name.length > 80
        ? 'greater-than-80'
        : name.length > 60
        ? 'greater-than-60'
        : name.length > 30
        ? 'greater-than-30'
        : name.length > 17
        ? 'greater-than-17'
        : 'less-than-17-chars'
    "
  >
    {{ name }}
  </H3TSkewText>
</template>

<script>
  import H3TSkewText from '@/components/base/SkewText.vue';

  export default {
    components: { H3TSkewText },
    props: {
      name: {
        type: String,
        required: true,
      },
    },
  };
</script>

<style scoped>
  .card-name {
    text-align: right;
    position: absolute;
    line-height: 1.5em;
    right: 18px;
    width: 70%;
    /* font-size: 1.5em; */
  }

  .title-box span {
    font-weight: lighter;
  }

  .greater-than-100 {
    bottom: -1.7em;
    font-size: 1.2em;
  }

  .greater-than-80 {
    bottom: -1.7em;
    font-size: 1.28em;
  }

  .greater-than-60 {
    bottom: -1.7em;
    font-size: 1.45em;
  }

  .greater-than-30 {
    bottom: -1.2em;
    font-size: 1.6em;
  }

  .greater-than-17 {
    bottom: -1.3em;
    font-size: 1.8em;
  }

  .less-than-17-chars {
    bottom: -0.7em;
    font-size: 1.8em;
  }
</style>
