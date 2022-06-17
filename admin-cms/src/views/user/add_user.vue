<template>
  <div class="app-container">
    <el-form ref="form" :model="form" label-width="120px">
      <el-form-item label="Activity name">
        <el-input v-model="form.name" />
      </el-form-item>
      <el-form-item label="Username">
        <el-input v-model="form.username" />
      </el-form-item>
      <el-form-item label="Email">
        <el-input v-model="form.email" />
      </el-form-item>
      <el-form-item label="Password">
        <el-input v-model="form.password" type="password" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">Create</el-button>
        <el-button @click="onCancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { assignUser } from '@/api/user'

export default {
  data() {
    return {
      defaultForm: {
        name: null,
        username: null,
        email: null,
        password: null
      },
      form: null
    }
  },
  created() {
    this.form = Object.assign({}, this.defaultForm)
  },
  methods: {
    onSubmit() {
      assignUser(this.form).then(
        response => {
          if (response.code === 0) {
            this.$notify({
              message: 'Create success',
              type: 'success'
            })
            this.form = Object.assign({}, this.defaultForm)
            this.$router.push('/user/listing')
          }
        })
    },
    onCancel() {
      this.form = Object.assign({}, this.defaultForm)
      this.$message({
        message: 'cancel!',
        type: 'warning'
      })
    }
  }
}
</script>

<style scoped>
.line{
  text-align: center;
}
</style>

