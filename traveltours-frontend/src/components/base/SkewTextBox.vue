<template>
  <section class="stripe">
    <div class="stripe__content">
      <h1 class="text-h3">
        Check this rotation with the straight edges and non-skewed text!!!
      </h1>
      <p class="text-h4">
        If you're wanting to get into punk-rock design, rotated areas are really
        cool and you'll look hip and cool.
      </p>
    </div>
  </section>
</template>

<script>
  export default {};
</script>

<style scoped>
  .stripe {
    background-image: linear-gradient(
      to bottom right,
      #0056c7 0%,
      #00a597af 84%
    );
    color: white;
    padding: 5em;
    /* transform: skew(0deg, -10deg); */
    margin-top: 2em;
    clip-path: polygon(0 0, 100% 0%, 100% 85%, 0% 100%);
  }
  /* .stripe {
    background-image: linear-gradient(240deg, #eaee44, #90ec19);
    padding: 30em 5em 5em 5em;
    transform: skew(0deg, -10deg);
    margin-top: -10em;
    z-index: -1;
  } */
  .stripe__content {
    /* transform: skew(5deg); */
  }
</style>
