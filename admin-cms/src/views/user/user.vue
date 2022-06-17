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
      <el-table-column label="Username">
        <template slot-scope="scope">
          <span>{{ scope.row.username }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Email">
        <template slot-scope="scope">
          <span>{{ scope.row.email }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Avatar">
        <template slot-scope="scope">
          <el-image :src="scope.row.avatar" />
        </template>
      </el-table-column>
      <el-table-column label="Role">
        <template slot-scope="scope">
          <span>{{ scope.row.roles[0].name }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Status" class-name="status-col" width="100">
        <template slot-scope="{row}">
          <el-tag :type="row.status | statusFilter">
            {{ row.status }}
          </el-tag>
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

  </div>
</template>

<script>
import { getListUser } from '@/api/user'

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
      list: null,
      user: null,
      listLoading: true
    }
  },
  created() {
    this.fetchData()
  },
  methods: {
    fetchData() {
      this.listLoading = true
      getListUser().then(response => {
        this.list = response.data
        if (this.list.length > 0) {
          this.user = this.list[0]
        } else {
          this.user = {
            name: '',
            description: ''
          }
        }
        this.listLoading = false
      })
    }
  }
}
</script>
