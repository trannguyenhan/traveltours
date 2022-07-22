<template>
  <div class="app-container">
    <div class="header-container">
      <el-button
        class="filter-item"
        style="margin-left: 10px"
        type="primary"
        icon="el-icon-edit"
        @click="handleCreate()"
      >
        Add
      </el-button>
    </div>
    <br>
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
      <el-table-column label="Code">
        <template slot-scope="scope">
          {{ scope.row.code }}
        </template>
      </el-table-column>
      <el-table-column label="Discount" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.discount }}</span>
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
        :model="coupon"
        label-position="left"
        style="width: 400px; margin-left: 50px"
      >
        <el-form-item label="Code" prop="title">
          <el-input v-model="coupon.code" />
        </el-form-item>
        <el-form-item label="Discount" prop="title">
          <el-input v-model="coupon.discount" type="number" label="Range" />
        </el-form-item>
        <el-form-item label="Threshold" prop="title">
          <el-input
            v-model="coupon.threshold"
            type="number"
            step="1"
            label="Range"
          />
        </el-form-item>
        <el-form-item label="Start Date" prop="title">
          <el-input
            v-model="coupon.start_date"
            placeholder="Pick a date"
            type="date"
          />
        </el-form-item>
        <el-form-item label="End Date" prop="title">
          <el-input
            v-model="coupon.end_date"
            placeholder="Pick a date"
            type="date"
          />
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false"> Cancel </el-button>
        <el-button
          v-if="!dialogCreate"
          type="primary"
          @click="updateCoupon(coupon)"
        >
          Update
        </el-button>
        <el-button
          v-if="dialogCreate"
          type="primary"
          @click="createCoupon(coupon)"
        >
          Create
        </el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>

import { getListCoupon, updateCoupon, deleteCoupon, createCoupon } from '@/api/coupon'

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
      list: null,
      listLoading: true,
      dialogFormVisible: false,
      dialogCreate: false,
      coupon: {
        code: null,
        discount: 0,
        threshold: 0,
        start_date: null,
        end_date: null
      }
    }
  },
  created() {
    this.fetchData()
  },
  methods: {
    fetchData() {
      this.listLoading = true
      getListCoupon().then(response => {
        this.list = response.data
        this.listLoading = false
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
    updateCoupon(coupon) {
      updateCoupon(coupon).then((response) => {
        if (response.code === 0) {
          this.$notify({
            message: 'Update success',
            type: 'success'
          })
          this.dialogFormVisible = false
        }
      })
    },
    createCoupon(coupon) {
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
    }
  }
}
</script>
