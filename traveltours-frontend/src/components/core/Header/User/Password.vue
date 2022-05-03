<template>
  <v-card flat dark color="#003C71CC">
    <v-card-text>
      <v-form ref="form">
        <v-text-field
          id="password"
          label="Password"
          name="password"
          prepend-icon="mdi-lock"
          :type="showPass ? 'text' : 'password'"
          clearable
          :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
          color="secondary"
          @click:append="showPass = !showPass"
        />
        <v-text-field
          id="passwordConfirm"
          label="Password Confirm"
          name="passwordConfirm"
          prepend-icon="mdi-lock"
          :type="showPass ? 'text' : 'password'"
          :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
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
