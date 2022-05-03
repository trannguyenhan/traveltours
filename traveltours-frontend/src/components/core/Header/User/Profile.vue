<template>
  <v-card flat dark color="#003C71CC">
    <v-card-text>
      <v-form ref="form">
        <v-text-field
          label="Name"
          name="name"
          prepend-icon="mdi-account"
          type="text"
          clearable
          autofocus
          color="secondary"
        />
        <v-text-field
          label="Email"
          name="email"
          prepend-icon="mdi-email"
          type="text"
          clearable
          color="secondary"
        />

        <v-text-field
          id="photo"
          label="URL of Profile Photo (Optional)"
          name="photo"
          prepend-icon="mdi-face-outline"
          type="text"
          clearable
          color="secondary"
        />
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer />
      <v-btn fab small outlined class="mt-n5 mb-2" color="secondary">
        <v-icon>mdi-pen</v-icon>
      </v-btn>
      <v-spacer />
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {};
</script>

<style scoped></style>
