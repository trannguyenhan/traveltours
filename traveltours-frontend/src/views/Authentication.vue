<template>
  <div class="mt-12">
    <v-row justify="center">
      <TrnAuthTab />
    </v-row>
  </div>
</template>

<script>
  import TrnAuthTab from '@/components/core/Header/Auth/AuthTab';

  export default {
    components: {
      TrnAuthTab,
    },
  };
</script>

<style scoped></style>
