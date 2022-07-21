<template>
  <v-text-field
    v-model="keyword"
    class="search-bar"
    type="text"
    label="Tìm kiếm tour..."
    @change="fetchTours()"
  />
</template>

<script>
  import { FETCH_TOURS } from '@/store/type/actions';
  import { mapActions } from 'vuex';

  export default {
    data: () => ({
      keyword: null,
    }),
    methods: {
      ...mapActions([FETCH_TOURS]),
      async fetchTours() {
        this.$route.query.keyword = this.keyword;
        console.log(this.$route.query);
        await this.$store.dispatch(FETCH_TOURS, this.$route.query);
      },
    },
  };
</script>

<style scoped>
  .search-bar {
    width: 100%;
    display: block;
    padding-top: 20px;
    padding-left: 45px;
    background: url('../../../assets/search_icon.png') no-repeat 15px center;
    background-size: 15px 15px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
  }
</style>
