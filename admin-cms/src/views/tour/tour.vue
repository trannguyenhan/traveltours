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
      <el-table-column label="Name" width="200">
        <template slot-scope="scope">
          {{ scope.row.name }}
        </template>
      </el-table-column>
      <el-table-column label="Start Date">
        <template slot-scope="scope">
          <span>{{ formatDate(scope.row.start_date) }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Range">
        <template slot-scope="scope">
          <span>{{ scope.row.range }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Place">
        <template slot-scope="scope">
          <span>{{ scope.row.places }}</span>
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
          <el-input v-model="tour.name" disabled="true" />
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false"> Cancel </el-button>
        <el-button
          v-if="!dialogCreate"
          type="primary"
          @click="updateUser(user)"
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
import { getListTour } from "@/api/tour";
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
        console.log(this.list);
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

    // listRole(roles) {
    //   let result = [];
    //   if (roles.length > 0) {
    //     for (let i = 0; i < roles.length; i++) {
    //       result.push(roles[i].name);
    //     }
    //   }
    //   return result;
    // },

    updateUser(user) {
      updateUser(user).then((response) => {
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
      this.user = this.list[index];
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
</style>
