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
      <el-table-column align="center" label="Tour Name">
        <template slot-scope="scope">
          {{ scope.row.tour.name }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="User name">
        <template slot-scope="scope">
          {{ scope.row.user.username }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Adult Count">
        <template slot-scope="scope">
          {{ scope.row.adult_count }}
        </template>
      </el-table-column>

      <el-table-column align="center" label="Child Count">
        <template slot-scope="scope">
          {{ scope.row.child_count }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Total Price">
        <template slot-scope="scope">
          {{ scope.row.total_price }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Tax">
        <template slot-scope="scope">
          {{ scope.row.tax }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Total Price">
        <template slot-scope="scope">
          {{ convertPayment(scope.row.payment_method) }}
        </template>
      </el-table-column>

      <el-table-column label="Status" class-name="status-col" width="100">
        <template slot-scope="{ row }">
          <el-tag :type="row.status | statusFilter">
            {{ row.status }}
          </el-tag>
        </template>
      </el-table-column>

      <el-table-column
        label="Actions"
        align="center"
        width="300"
        class-name="small-padding fixed-width"
      >
        <template slot-scope="scope">
          <el-button type="primary" size="mini" @click="accept(scope.$index)">
            Accept
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
  </div>
</template>

<script>
import {
  getListOrder,
  updateOrder,
  acceptOrder,
  deleteOrder,
} from "@/api/order";
export default {
  filters: {
    statusFilter(status) {
      const statusMap = {
        active: "success",
        penning: "danger",
      };
      return statusMap[status];
    },
  },
  data() {
    return {
      dialogFormVisible: false,
      dialogCreate: false,
      list: null,
      order: null,
      listLoading: true,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    convertPayment(method) {
      const paymentMethod = {
        cod: "Thanh toán tiền mặt",
      };
      return paymentMethod[method];
    },
    async fetchData() {
      this.listLoading = true;

      getListOrder().then((response) => {
        this.list = response.data;
        console.log(this.list[0]);
        if (this.list.length > 0) {
          this.order = this.list[0];
        } else {
          this.order = {
            name: "",
          };
        }
        this.listLoading = false;
      });
    },

    formatDate(dat) {
      const date = new Date(dat);
      return date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear();
    },

    detail(index) {
      this.order = this.list[index];
      this.dialogFormVisible = true;
      this.dialogCreate = false;
    },

    accept(index) {
      this.list[index].status = "active";
      acceptOrder({
        id: this.list[index].id,
      }).then((response) => {
        if (response.code === 0) {
          this.$notify({
            message: "Update success",
            type: "success",
          });
          this.dialogFormVisible = false;
        }
      });
    },

    handleDelete(index) {
      deleteOrder({ id: this.list[index].id }).then((response) => {
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
