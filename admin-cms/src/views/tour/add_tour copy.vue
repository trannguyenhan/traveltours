<template>
  <div class="container">
    <el-form
      ref="dataForm"
      :model="tour"
      label-position="left"
      style="width: 500px; margin-left: 250px"
    >
      <el-form-item label="Name" prop="title">
        <el-input v-model="tour.name" />
      </el-form-item>
      <el-form-item label="Category"
        ><el-select
          v-model="tour.categories"
          multiple
          placeholder="Select Category"
        >
          <el-option
            v-for="item in this.all_categories"
            :key="Number(item.id)"
            :label="item.name"
            :value="Number(item.id)"
          /> </el-select
      ></el-form-item>
      <el-form-item label="Range" prop="title">
        <el-input v-model="tour.range" type="number" label="Range" />
      </el-form-item>
      <el-form-item label="Max Slot" prop="title">
        <el-input
          v-model="tour.max_slot"
          type="number"
          step="1"
          label="Range"
        />
      </el-form-item>

      <el-form-item label="Hotel Star" prop="title">
        <el-input
          v-model="tour.hotel_star"
          type="number"
          step="1"
          :min="1"
          :max="5"
          label=""
        />
      </el-form-item>
      <el-form-item label="Vehicle" prop="title">
        <el-input v-model="tour.vehicle" />
      </el-form-item>
      <el-form-item label="Start Date" prop="title">
        <el-input
          v-model="tour.start_date"
          placeholder="Pick a date"
          type="date"
        />
      </el-form-item>

      <el-form-item label="Places"
        ><el-select v-model="tour.places" multiple placeholder="Select Places">
          <el-option
            v-for="item in this.all_places"
            :key="Number(item.id)"
            :label="item.name"
            :value="Number(item.id)"
          /> </el-select
      ></el-form-item>

      <el-form-item label="Guide"
        ><el-select v-model="tour.tour_guide_id" placeholder="Select Guide">
          <el-option
            v-for="item in this.all_guides"
            :key="Number(item.id)"
            :label="item.name"
            :value="Number(item.id)"
          /> </el-select
      ></el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">Create</el-button>
        <el-button @click="onCancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { createTour } from "@/api/tour";
import { getListPlace } from "@/api/place";
import { getListCategory } from "@/api/category";
import { getListTourGuide } from "@/api/tour_guide";


export default {
  data() {
    return {
      tour: {
        name: null,
        slot: 0,
        hotel_star: null,
        range: null,
      },
      defaultTour: {
        name: null,
        hotel_star: 5,
        max_slot: 50,
        range: 5,
      },
      all_places: [],
      all_categories: [],
      all_guides: [],
      listLoading: null,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      this.tour = Object.assign({}, this.defaultTour);
      getListPlace().then((response) => {
        this.all_places = response.data;
      });

      getListCategory().then((response) => {
        this.all_categories = response.data;
      });

      getListTourGuide().then((response) => {
        this.all_guides = response.data;
      });
    },

    onSubmit() {
    //   this.tour.places = this.convertNumber(this.tour.places);
      //   this.tour.range = Number(this.tour.range);
      console.log(this.tour);
      createTour(this.tour).then((response) => {
        if (response.code === 0) {
          this.$notify({
            message: "Create success",
            type: "success",
          });
          this.$router.push("/tour/listing");
        }
      });
    },

    onCancel() {
      this.tour = Object.assign({}, this.defaultTour);
      this.$message({
        message: "cancel!",
        type: "warning",
      });
    },

    convertNumber(array) {
      for (let i = 0; i < array.length; i++) {
        array[i] = Number(array[i]);
      }
      return array;
    },
  },
};
</script>

<style scoped>
.line {
  text-align: center;
}
.m-2 {
  width: 500px;
}
a {
  text-decoration: none;
}
</style>
