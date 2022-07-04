<template>
  <div>
    <v-row justify="end" align="center">
      <v-btn
        depressed
        color="secondary"
        fab
        height="25px"
        width="25px"
        class="mr-2"
        @mousedown="decrement"
        ><v-icon>mdi-minus</v-icon>
      </v-btn>

      <v-btn
        depressed
        color="secondary"
        fab
        height="25px"
        width="25px"
        class="mr-6"
        @mousedown="increment"
        ><v-icon>mdi-plus</v-icon>
      </v-btn>
    </v-row>

    <!-- <v-text-field
          v-model.number="computedValue"
          style="max-width: 90px"
          append-outer-icon="mdi-plus"
          prepend-icon="mdi-minus"
          single-line
          @click:append-outer="increment"
          @click:prepend="decrement"
        /> -->
  </div>
</template>

<script>
  export default {
    methods: {
      increment() {
        this.value = parseInt(this.value, 10) + 1;
        this.$emit('changeValue', this.value);
      },
      decrement() {
        if (this.value > 0) this.value = parseInt(this.value, 10) - 1;
        this.$emit('changeValue', this.value);
      },
    },
    props: {
      num: {
        type: Number,
      },
    },
    data() {
      return {
        value: this.num,
      };
    },
  };
</script>

<style scoped></style>
