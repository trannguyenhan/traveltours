<template>
  <v-container style="z-index: 1">
    <v-footer class="py-3" absolute app color="primary" padless>
      <v-row
        :justify="$vuetify.breakpoint.smAndDown ? 'center' : 'start'"
        :class="!$vuetify.breakpoint.smAndDown ? 'ml-16' : ''"
        class="primary white--text"
        no-gutters
      >
        <v-img
          max-width="130"
          class="ml-md-12"
          contain
          alt="tourino logo"
          src="../../assets/H3T.png"
        />
        <p class="text-body-2" style="margin: auto 0.5em">
          <strong>©</strong> {{ new Date().getFullYear() }} H3T, Inc.
        </p>
      </v-row>
      <v-row justify="center" justify-md="end" no-gutters class="mr-md-16">
        <v-btn
          v-for="link in links"
          :key="link"
          color="white"
          text
          rounded
          class="text-md-body-2 text-caption"
        >
          {{ link }}
        </v-btn>
      </v-row>
    </v-footer>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      links: [
        'About Us',
        'Blog',
        'Careers',
        'Terms & Conditions',
        'Contact Us',
      ],
    }),
  };
</script>
