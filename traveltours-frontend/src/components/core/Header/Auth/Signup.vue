<template>
  <v-card class="rounded-bl-xl" flat dark color="#003C71CC">
    <v-card-text>
      <v-form ref="form">
        <v-text-field
          v-model="name"
          label="Name"
          name="name"
          prepend-icon="mdi-account"
          type="text"
          clearable
          autofocus
          color="secondary"
        />
        <v-text-field
          v-model="username"
          label="Username"
          name="username"
          prepend-icon="mdi-account-plus"
          type="text"
          clearable
          autofocus
          color="secondary"
        />
        <v-text-field
          v-model="email"
          label="Email"
          name="email"
          prepend-icon="mdi-email"
          type="text"
          clearable
          color="secondary"
        />

        <v-text-field
          id="password"
          v-model="password"
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
          v-model="passwordConfirm"
          label="Password Confirm"
          name="passwordConfirm"
          prepend-icon="mdi-lock"
          :type="showPass ? 'text' : 'password'"
          :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
          clearable
          color="secondary"
          @click:append="showPass = !showPass"
        />
        <v-text-field
          id="photo"
          v-model="photo"
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

      <v-btn
        fab
        small
        outlined
        class="mt-n5 mb-2"
        color="secondary"
        @click="onSubmit()"
      >
        <v-icon>mdi-pen</v-icon>
      </v-btn>
      <v-spacer />
    </v-card-actions>
  </v-card>
</template>

<script>
  import { REGISTER } from '@/store/type/actions';

  export default {
    data: () => ({
      showPass: false,
      name: null,
      username: null,
      email: null,
      password: null,
      passwordConfirm: null,
      photo: null,
    }),
    methods: {
      onSubmit() {
        this.$store
          .dispatch(REGISTER, {
            name: this.name,
            email: this.email,
            username: this.username,
            password: this.password,
            passwordConfirm: this.passwordConfirm,
            photo: this.photo,
          })
          .then(() => {
            this.$router.push({ path: '/authentication' });
          });
      },
    },
  };
</script>

<style scoped></style>
