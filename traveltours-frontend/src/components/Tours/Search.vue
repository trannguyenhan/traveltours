<template>
  <v-text-field
    v-model="input"
    class="search-bar"
    type="text"
    label="Tìm kiếm tour..."
  />
</template>

<script></script>

<style scoped>
  .search-bar {
    width: 100%;
    display: block;
    padding-top: 20px;
    padding-left: 45px;
    background: url('../../assets/search_icon.png') no-repeat 15px center;
    background-size: 15px 15px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
  }
</style>
