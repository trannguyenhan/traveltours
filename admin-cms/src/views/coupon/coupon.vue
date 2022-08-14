<template>
  <div class="app-container">
    <input type="text" v-model="tourName" placeholder="Search Tour..." />
    <el-button @click="fetchData()">Search</el-button>
    <div class="header-container">
      <el-button class="filter-item" style="margin-left: 10px" type="primary" icon="el-icon-edit"
        @click="handleCreate()">
        Add
      </el-button>
    </div>
    <br>
    <el-table v-loading="listLoading" :data="list" element-loading-text="Loading" border fit highlight-current-row>
      <el-table-column align="center" label="ID" width="95">
        <template slot-scope="scope">
          {{ scope.$index + 1 }}
        </template>
      </el-table-column>
      <el-table-column label="Tour">
        <template slot-scope="scope">
          {{ scope.row.tour.name }}
        </template>
      </el-table-column>
      <el-table-column label="Code">
        <template slot-scope="scope">
          {{ scope.row.code }}
        </template>
      </el-table-column>
      <el-table-column label="Discount" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.discount }}%</span>
        </template>
      </el-table-column>
      <el-table-column label="Threshold" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.threshold }} VNĐ</span>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="created_at" label="Start Date" width="200">
        <template slot-scope="scope">
          <i class="el-icon-time" />
          <span>{{ scope.row.start_date }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="created_at" label="End Date" width="200">
        <template slot-scope="scope">
          <i class="el-icon-time" />
          <span>{{ scope.row.end_date }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Actions" align="center" width="300" class-name="small-padding fixed-width">
        <template slot-scope="scope">
          <el-button type="primary" size="mini" @click="handleUpdate(scope.$index)">
            Edit
          </el-button>
          <el-button size="mini" type="danger" @click="handleDelete(scope.$index)">
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <p class="nextprev">
      <el-button class="paginate" @click="prevPage">
        Previous
      </el-button>

      <el-button class="paginate1">
        page {{ this.currentPage }} of {{ this.pageNumber }}
      </el-button>
      <el-button class="paginate" @click="nextPage">
        Next
      </el-button>
    </p>
    <el-dialog title="Edit Tour" :visible.sync="dialogFormVisible">
      <el-form ref="dataForm" :model="coupon" label-position="left" style="width: 400px; margin-left: 50px">
        <el-form-item label="Tour">
          <el-select v-model="coupon.tour_id" placeholder="Select Tour">
            <el-option v-for="item in this.allTours" :key="Number(item.id)" :label="item.name"
              :value="Number(item.id)" />
          </el-select>
        </el-form-item>
        <el-form-item label="Code" prop="title">
          <el-input v-model="coupon.code" />
        </el-form-item>
        <el-form-item label="Discount" prop="title">
          <el-input v-model="coupon.discount" type="number" label="Range" />
        </el-form-item>
        <el-form-item label="Threshold" prop="title">
          <el-input v-model="coupon.threshold" type="number" step="1" label="Range" />
        </el-form-item>
        <el-form-item label="Start Date" prop="title">
          <el-input v-model="coupon.start_date" placeholder="Pick a date" type="date" />
        </el-form-item>
        <el-form-item label="End Date" prop="title">
          <el-input v-model="coupon.end_date" placeholder="Pick a date" type="date" />
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false"> Cancel </el-button>
        <el-button v-if="!dialogCreate" type="primary" @click="updateCoupon(coupon)">
          Update
        </el-button>
        <el-button v-if="dialogCreate" type="primary" @click="createCoupon(coupon)">
          Create
        </el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>

import { getListCoupon, updateCoupon, deleteCoupon, createCoupon } from '@/api/coupon'
import { getAllTours } from '@/api/tour'

export default {
  filters: {
    statusFilter(status) {
      const statusMap = {
        published: 'success',
        draft: 'gray',
        deleted: 'danger'
      }
      return statusMap[status]
    }
  },
  data() {
    return {
      errors: [],
      list: null,
      listLoading: true,
      dialogFormVisible: false,
      dialogCreate: false,
      coupon: {
        name: '',
        code: null,
        discount: 0,
        threshold: 0,
        start_date: null,
        end_date: null,
        tour_id: null
      },
      allTours: [],
      currentPage: 1,
      total: 0,
      pageNumber: 0,
      tourName: ''
    }
  },
  created() {
    this.fetchData()
  },
  methods: {
    fetchData() {
      this.listLoading = true
      getListCoupon(this.currentPage, this.tourName).then(response => {
        this.total = response.total;
        this.pageNumber = (this.total - (this.total % 10)) / 10 + 1;
        this.list = response.data
        for (let i = 0; i < this.list.length; i++) {
          this.list[i].start_date = new Date(this.list[i].start_date).toISOString().slice(0, 10)
          this.list[i].end_date = new Date(this.list[i].end_date).toISOString().slice(0, 10)
        }
        this.listLoading = false
      })
      getAllTours().then(res => {
        this.allTours = res.data
      })
    },
    handleUpdate(index) {
      this.coupon = this.list[index]
      this.dialogFormVisible = true
      this.dialogCreate = false
    },

    handleDelete(index) {
      deleteCoupon({ id: this.list[index].id }).then((response) => {
        if (response.code === 0) {
          this.$notify({
            message: 'Update success',
            type: 'success'
          })
          this.fetchData()
        }
      })
    },
    checkForm() {
      this.errors = []

      if (!this.coupon.tour_id) {
        this.errors.push("Chưa chọn tour");
      }
      if (!this.coupon.code) {
        this.errors.push("Chưa nhập mã code")
      } else {
        if (this.coupon.code.length < 6) {
          this.errors.push("Mã code tối thiểu 6 kí tự")
        }
      }

      if (!this.coupon.discount) {
        this.errors.push("Chưa có discount")
      }
      if (this.coupon.discount > 100) {
        this.errors.push("Giảm giá tối đa 100%")
      }
      if (!this.coupon.threshold) {
        this.errors.push("Chưa chọn ngưỡng giảm giá tối đa")
      }
      if (!this.coupon.start_date) {
        this.errors.push("Chưa chọn ngày bắt đầu")
      }
      if (!this.coupon.end_date) {
        this.errors.push("Chưa chọn ngày hết hạn");
      }
      if (this.coupon.start_date > this.coupon.end_date) {
        this.errors.push("Ngày kết hạn phải sau ngày bắt đầu");
      }

      if (this.errors.length > 0) {
        this.$notify({
          message: this.errors[0],
          type: 'error'
        })
        return false
      }
      return true


      // if (this.errors.length == 0) {
      //   this.createCoupon(this.coupon)
      // }
    },
    updateCoupon(coupon) {
      if (this.checkForm()) {
        updateCoupon(coupon).then((response) => {
          if (response.code === 0) {

            // this.coupon.tour.name = this.allTours[response.data.tour_id].name
            // console.log(response.data.tour_id, this.allTours);
            for (let i = 0; i < this.allTours.length; i++) {
              if (this.allTours[i].id == response.data.tour_id) {
                this.coupon.tour.name = this.allTours[i].name

              }
            }
            // console.log(111, this.coupon.tour.name);
            // console.log(this.coupon.tour.name);
            this.$notify({
              message: 'Update success',
              type: 'success'
            })
            this.dialogFormVisible = false
          }
        })
      }

    },
    createCoupon(coupon) {
      if (this.checkForm()) {
        createCoupon(coupon).then((response) => {
          if (response.code === 0) {
            this.$notify({
              message: 'Create success',
              type: 'success'
            })
            this.dialogFormVisible = false
            this.fetchData()
          }
        })
      }

    },
    handleCreate() {
      this.coupon = {
        code: null,
        discount: 0,
        threshold: 0,
        start_date: null,
        end_date: null
      }
      this.dialogFormVisible = true
      this.dialogCreate = true
    },
    nextPage() {
      if (this.currentPage + 1 <= this.pageNumber) {
        this.currentPage += 1;
        this.fetchData()
      }
    },

    prevPage() {
      if (this.currentPage - 1 >= 1) {
        this.currentPage -= 1;
        this.fetchData();
      }
    }

  }
}
</script>
<style scoped>
.nextprev {
  position: fixed;
  left: 900px;
  display: inline-block;
  bottom: 50px;

}
</style>
