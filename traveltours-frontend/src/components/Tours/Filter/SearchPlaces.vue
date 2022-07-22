<template>
  <v-text-field
    v-model="keyword"
    class="search-bar"
    type="text"
    label="Tìm kiếm địa điểm..."
    @change="fetchPlaces()"
  />
</template>

<script>
  import { FETCH_PLACES } from '@/store/type/actions';
  import { mapActions } from 'vuex';

  export default {
    data: () => ({
      keyword: null,
    }),
    methods: {
      ...mapActions([FETCH_PLACES]),
      async fetchPlaces() {
        this.$route.query.keyword = this.keyword;
        await this.$store.dispatch(FETCH_PLACES, this.$route.query);
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
