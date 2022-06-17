<template>
  <div class="app-container">
    <el-input v-model="filterText" placeholder="Filter keyword" style="margin-bottom:30px;" />

    <el-tree
      ref="tree2"
      :data="data2"
      :props="defaultProps"
      :filter-node-method="filterNode"
      class="filter-tree"
      default-expand-all
    />

  </div>
</template>

<script>
export default {

  data() {
    return {
      filterText: '',
      data2: [{
        id: 1,
        label: 'Admin',
        children: [{
          id: 4,
          label: 'User management'
        }]
      }, {
        id: 2,
        label: 'Seller',
        children: [{
          id: 5,
          label: 'Tour management'
        }, {
          id: 6,
          label: 'Place management'
        }]
      }, {
        id: 3,
        label: 'User',
        children: [{
          id: 7,
          label: 'Tour listing, booking, review'
        }, {
          id: 8,
          label: 'Place listing, review'
        }]
      }, {
        id: 4,
        label: 'Guest',
        children: [{
          id: 7,
          label: 'Tour listing'
        }, {
          id: 8,
          label: 'Place listing'
        }]
      }],
      defaultProps: {
        children: 'children',
        label: 'label'
      }
    }
  },
  watch: {
    filterText(val) {
      this.$refs.tree2.filter(val)
    }
  },

  methods: {
    filterNode(value, data) {
      if (!value) return true
      return data.label.indexOf(value) !== -1
    }
  }
}
</script>

