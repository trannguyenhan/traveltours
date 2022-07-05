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
import { getListTour, updateTour } from "@/api/tour";
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
      tour: null,
      listLoading: true,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      this.listLoading = true;
      getListTour().then((response) => {
        this.list = response.data;
        if (this.list.length > 0) {
          this.tour = this.list[0];
        } else {
          this.tour = {
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

    updateTour(tour) {
      tour.dest = tour.dest.id;
      console.log(tour);
      updateTour(tour).then((response) => {
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
      this.tour = this.list[index];
      this.dialogFormVisible = true;
      this.dialogCreate = false;
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
