<template>
  <div class="app-container">
    <el-table
      v-loading="listLoading"
      :data="list"
      element-loading-text="Loading"
      border
      fit
      highlight-current-row
    >
      <el-table-column align="center" label="ID" width="95">
        <template slot-scope="scope">
          {{ scope.$index }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Name" width="200">
        <template slot-scope="scope">
          {{ scope.row.name }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Start Date">
        <template slot-scope="scope">
          <span>{{ formatDate(scope.row.start_date) }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Range">
        <template slot-scope="scope">
          <span>{{ scope.row.range }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Max Slot">
        <template slot-scope="scope">
          <span>{{ scope.row.max_slot }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Remaining Slot">
        <template slot-scope="scope">
          <span>{{ scope.row.slot }}</span>
        </template>
      </el-table-column>

      <el-table-column
        label="Actions"
        align="center"
        width="300"
        class-name="small-padding fixed-width"
      >
        <template slot-scope="scope">
          <el-button
            type="primary"
            size="mini"
            @click="handleUpdate(scope.$index)"
          >
            Edit
          </el-button>
          <el-button
            size="mini"
            type="danger"
            @click="handleDelete(scope.$index)"
          >
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog title="Edit Tour" :visible.sync="dialogFormVisible">
      <el-form
        ref="dataForm"
        :model="tour"
        label-position="left"
        style="width: 400px; margin-left: 50px"
      >
        <el-form-item label="Name" prop="title">
          <el-input v-model="tour.name" />
        </el-form-item>
        <el-form-item
          label="Category"
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
          /> </el-select></el-form-item>
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
        <el-form-item label="Remaining Slot" prop="title">
          <el-input v-model="tour.slot" type="number" step="1" label="" />
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
        <el-form-item label="Gía vé người lớn" prop="title">
          <el-input
            v-model="tour.price.adult"
            type="number"
            step="1"
            :min="1"
          />
        </el-form-item>
        <el-form-item label="Giá vé trẻ em" prop="title">
          <el-input
            v-model="tour.price.child"
            type="number"
            step="1"
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

        <el-form-item
          label="Places"
        ><el-select
          v-model="tour.places"
          multiple
          placeholder="Select Places"
        >
          <el-option
            v-for="item in this.all_places"
            :key="Number(item.id)"
            :label="item.name"
            :value="Number(item.id)"
          /> </el-select></el-form-item>

        <el-form-item label="Guide"><el-select v-model="tour.tour_guide_id" placeholder="Select Guide">
          <el-option
            v-for="item in this.all_guides"
            :key="Number(item.id)"
            :label="item.name"
            :value="Number(item.id)"
          /> </el-select></el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false"> Cancel </el-button>
        <el-button
          v-if="!dialogCreate"
          type="primary"
          @click="updateTour(tour)"
        >
          Update
        </el-button>
        <el-button
          v-if="dialogCreate"
          type="primary"
          @click="createCategory(category)"
        >
          Create
        </el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import { getListTour, updateTour, deleteTour, getDetailTour } from '@/api/tour'
import { getListPlace } from '@/api/place'
import { getListCategory } from '@/api/category'
import { getListTourGuide } from '@/api/tour_guide'
export default {
  filters: {
    statusFilter(status) {
      const statusMap = {
        active: 'success',
        locked: 'danger'
      }
      return statusMap[status]
    }
  },
  data() {
    return {
      dialogFormVisible: false,
      dialogCreate: false,
      list: null,
      tour: null,
      listLoading: true,
      places: [],
      all_places: [],
      all_categories: [],
      all_guides: []
    }
  },
  created() {
    this.fetchData()
  },
  methods: {
    getDetailTour(id) {
      return getDetailTour(id)
    },
    convertNumber(array) {
      for (let i = 0; i < array.length; i++) {
        array[i] = Number(array[i])
      }
      return array
    },
    async fetchData() {
      this.listLoading = true

      getListTour().then((response) => {
        this.list = response.data
        if (this.list.length > 0) {
          getDetailTour(this.list[0].id).then((response) => {
            this.tour = response.data
            console.log(this.tour)
          })
        } else {
          this.tour = {
            name: '',
            description: ''
          }
        }
        this.listLoading = false
      })

      getListPlace().then((response) => {
        this.all_places = response.data
      })

      getListCategory().then((response) => {
        this.all_categories = response.data
      })

      getListTourGuide().then((response) => {
        this.all_guides = response.data
      })
    },

    formatDate(dat) {
      const date = new Date(dat)
      return date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear()
    },

    updateTour(tour) {
      tour.dest = Number(tour.places[tour.places.length - 1])
      tour.adult_price = this.tour.price.adult
      tour.child_price = this.tour.price.child

      updateTour(tour).then((response) => {
        if (response.code === 0) {
          this.$notify({
            message: 'Update success',
            type: 'success'
          })
          this.dialogFormVisible = false
        }
      })
    },
    handleUpdate(index) {
      this.tour = this.list[index]
      console.log(this.tour)
      getDetailTour(this.list[index].id).then((response) => {
        // this.tour = response.data;
        this.tour.places = this.convertNumber(this.tour.places)
        console.log(this.tour)
      })
      this.dialogFormVisible = true
      this.dialogCreate = false
    },

    handleDelete(index) {
      deleteTour({ id: this.list[index].id }).then((response) => {
        if (response.code === 0) {
          this.$notify({
            message: 'Update success',
            type: 'success'
          })
          this.fetchData()
        }
      })
    }
  }
}
</script>
<style lang="scss" scoped>
.user-avatar {
  cursor: pointer;
  width: 60px;
  height: 60px;
  border-radius: 10px;
}

.table {
  text-align: center;
}
</style>
