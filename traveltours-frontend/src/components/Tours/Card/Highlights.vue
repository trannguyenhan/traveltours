<template>
  <div>
    <div v-if="highlights != null">
      <v-row no-gutters>
        <div>
          <span style="font-size: 1.3em" class="ml-1">🌟</span>
          <span class="ml-2">{{ highlights }}</span>
        </div>
      </v-row>
    </div>
    <div v-else />
  </div>
</template>

<script>
  export default {
    props: {
      highlights: {
        type: String,
        required: true,
      },
    },
  };
</script>

<style scoped></style>
