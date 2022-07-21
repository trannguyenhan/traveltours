<template>
  <div class="pagination">
    <a href="#">&laquo;</a>
    <a
      v-for="(i, numPage) in numPages"
      v-if="numPage!==0"
      :key="i"
      href="#"
      :class="page === numPage? 'active' : ''"
      @click="handleClick(numPage)"
    >{{ numPage }}</a>
    <a href="#">&raquo;</a>
  </div>
</template>

<script>
export default {
  name: 'Pageable',
  props: {
    pageSize: {
      type: Number,
      default: 15
    },
    page: {
      type: Number,
      default: 1
    },
    numPages: {
      type: Number,
      default: 10
    }
  },
  methods: {
    handleClick(numPage) {
      this.$emit('change-num-page', numPage)
    }
  }
}
</script>

<style scoped>
.pagination {
  display: inline-block;
  margin-top: 10px;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
