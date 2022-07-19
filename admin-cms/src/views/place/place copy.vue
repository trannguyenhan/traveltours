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
      <el-table-column align="center" label="Tên địa điểm" width="200">
        <template slot-scope="scope">
          {{ scope.row.name }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Quận/Huyện" width="200">
        <template slot-scope="scope">
          {{ scope.row.district }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Phường/Xã" width="200">
        <template slot-scope="scope">
          {{ scope.row.ward }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Địa điểm cụ thể" width="200">
        <template slot-scope="scope">
          {{ scope.row.address_detail }}
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
    <el-dialog title="Edit Place" :visible.sync="dialogFormVisible">
      <el-form
        ref="dataForm"
        :model="place"
        label-position="left"
        style="width: 400px; margin-left: 50px"
      >
        <el-form-item label="Name" prop="title">
          <el-input v-model="place.name" />
        </el-form-item>

        <!-- <el-form-item label="Max Slot" prop="title">
          <el-input
            type="number"
            step="1"
            label="Range"
            v-model="tour.max_slot"
          />
        </el-form-item>
        <el-form-item label="Remaining Slot" prop="title">
          <el-input type="number" step="1" label="" v-model="tour.slot" />
        </el-form-item>
        <el-form-item label="Start Date" prop="title">
          <el-input
            step="1"
            placeholder="Pick a date"
            v-model="tour.slot"
            type="date"
          />
        </el-form-item>

        <el-form-item label="Places"
          ><el-select
            v-model="tour.places"
            multiple
            placeholder="Select Places"
          >
            <el-option
              v-for="item in this.all_places"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            /> </el-select
        ></el-form-item> -->
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false"> Cancel </el-button>
        <el-button v-if="!dialogCreate" type="primary" @click="updatePlace()">
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
import {
  getListPlace,
  updatePlace,
  deletePlace,
  getDetailPlace,
} from "@/api/place";

export default {
  filters: {
    statusFilter(status) {
      const statusMap = {
        active: "success",
        locked: "danger",
      };
      return statusMap[status];
    },
  },
  data() {
    return {
      dialogFormVisible: false,
      dialogCreate: false,
      list: null,
      listLoading: true,
      places: [],
      place: null,
      all_places: [],
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      this.listLoading = true;

      getListPlace().then((response) => {
        this.list = response.data;
        if (this.list.length > 0) {
          getDetailPlace(this.list[0].id).then((response) => {
            this.place = response.data;
          });
        } else {
          this.place = {
            name: "",
            description: "",
          };
        }
        this.listLoading = false;
      });
    },

    formatDate(dat) {
      let date = new Date(dat);
      return date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear();
    },

    updatePlace() {
      console.log(this.place);
      if (!this.place.ward) this.place.ward = "xã";
      updatePlace(this.place).then((response) => {
        // console.log(response.data);
        if (response.code === 0) {
          this.$notify({
            message: "Update success",
            type: "success",
          });
          this.dialogFormVisible = false;
        }
      });
    },
    handleUpdate(index) {
      // this.tour = this.list[index];
      getDetailPlace(this.list[index].id).then((response) => {
        this.place = response.data;
        // console.log(this.place);
      });
      this.dialogFormVisible = true;
      this.dialogCreate = false;
    },

    handleDelete(index) {
      deleteTour({ id: this.list[index].id }).then((response) => {
        if (response.code === 0) {
          this.$notify({
            message: "Update success",
            type: "success",
          });
          this.fetchData();
        }
      });
    },
  },
};
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
