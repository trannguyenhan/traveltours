<template>
  <div class="title-box">
    <span v-if="background" class="background"><slot /></span>
    <div v-else class="d-flex align-center justify-end"><slot /></div>
  </div>
</template>

<script>
  export default {
    props: {
      background: {
        type: Boolean,
      },
    },
  };
</script>

<style scoped>
  .title-box {
    transform: rotate(-6deg) skew(-6deg);
  }

  .title-box span {
    font-weight: 500;
    padding: 0.35em;
    box-decoration-break: clone;
  }

  .background {
    background-image: linear-gradient(
      to bottom right,
      #0056c7 0%,
      #00a597af 84%
    );
    color: white;
  }
</style>
