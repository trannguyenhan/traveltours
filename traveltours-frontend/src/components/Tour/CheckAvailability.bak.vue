<template>
  <!-- <v-card>
    <v-card-title>Select Date and Travelers</v-card-title>

    <v-card-text> hello </v-card-text>
  </v-card> -->

  <v-card class="sticky">
    <v-card-title class="headline grey lighten-2" primary-title
      >Select Date and Travelers</v-card-title
    >

    <v-form ref="form">
      <v-card-text>
        <v-text-field v-model="title" label="Title" prepend-icon="mdi-folder" />

        <v-textarea
          v-model="content"
          label="Information"
          prepend-icon="mdi-lead-pencil"
        />

        <!-- :return-value.sync="computedDateFormattedDatefns" -->
        <!-- ref="menuPickDate" -->
        <v-menu
          v-model="menuPickDate"
          :close-on-content-click="true"
          transition="scale-transition"
          offset-y
          min-width="290px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              :value="computedDateFormattedDatefns"
              label="Due Date"
              prepend-icon="mdi-calendar"
              readonly
              v-bind="attrs"
              clearable
              v-on="on"
            />
          </template>
          <v-date-picker v-model="date" scrollable>
            <!-- <v-spacer />
              <v-btn text color="primary" @click="menuPickDate = false"
                >Cancel</v-btn
              >
              <v-btn text color="primary" @click="$refs.menuPickDate.save(date)"
                >OK</v-btn
              > -->
          </v-date-picker>
        </v-menu>
      </v-card-text>

      <!-- <v-menu v-model="menuPickDate" :close-on-content-click="false">
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              :value="computedDateFormattedDatefns"
              clearable
              label="Due Date"
              readonly
              v-bind="attrs"
              v-on="on"
              @click:clear="date = null"
            />
          </template>
          <v-date-picker v-model="date" @change="menuPickDate = false" />
        </v-menu> -->

      <v-card-actions>
        <v-spacer />
        <v-btn text class="primary--text" @click="submit"> Add Project </v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
  import TrnPickTravelers from './PickTravelers';

  export default {
    components: {
      TrnPickTravelers,
    },
    data: () => ({
      title: '',
      content: '',
      dialog: false,
      menuPickDate: false,
      date: new Date().toISOString().substr(0, 10),
    }),
    computed: {
      computedDateFormattedDatefns() {
        return this.date ? format(parseISO(this.date), 'do MMM yyyy') : '';
      },
    },
    methods: {
      submit() {
        console.log(
          this.title,
          this.content,
          this.computedDateFormattedDatefns
        );
        this.dialog = false;
        this.resetData();
      },
      resetData() {
        Object.assign(this.$data, this.$options.data());
        // this.$data = { ...initialState() };
      },
    },
  };
</script>

<style scoped>
  .sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 2em;
  }
</style>
