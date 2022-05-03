<template>
  <v-card class="rounded-bl-xl" flat dark color="#003C71CC">
    <v-card-text>
      <v-form ref="form">
        <v-text-field
          label="Email"
          name="email"
          prepend-icon="mdi-email"
          type="text"
          autofocus
          color="secondary"
          clearable
        />
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer />
      <v-btn fab small outlined class="mt-n5 mb-2" color="secondary">
        <v-icon>mdi-send</v-icon>
      </v-btn>
      <v-spacer />
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {};
</script>

<style scoped></style>
