<template>
  <div class="container">
    <el-select
      v-model="place.province"
      class="m-2"
      placeholder="Tỉnh/Thành phố"
      size="large"
    >
      <el-option
        v-for="item in addressData"
        :key="item.Name"
        :label="item.Name"
        :value="item.Name"
      />
    </el-select>
    <el-select
      v-model="place.district"
      class="m-2"
      placeholder="Quận/Huyện"
      size="large"
    >
      <el-option
        v-for="item in listDistrict()"
        :key="item.Id"
        :label="item.Name"
        :value="item.Name"
      />
    </el-select>
    <el-select
      v-model="place.ward"
      class="m-2"
      placeholder="Phường/Xã"
      size="large"
    >
      <el-option
        v-for="item in listWard()"
        :key="item.Id"
        :label="item.Name"
        :value="item.Name"
      />
    </el-select>
  </div>
</template>

<script>
import { getAddressDetail } from "@/api/data";

export default {
  data() {
    return {
      place: {
        name: null,
        province: null,
        district: null,
        ward: null,
        description: null,
        address_detail: null,
        images: [],
      },
      districtList: [],
      wardList: [],
      listLoading: null,
      addressData: null,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    listDistrict() {
      for (let i = 0; i < this.addressData.length; i++) {
        if (this.addressData[i].Name == this.place.province) {
          this.districtList = this.addressData[i].Districts;
          return this.districtList;
        }
      }
    },
    listWard() {
      for (let i = 0; i < this.districtList.length; i++) {
        if (this.districtList[i].Name == this.place.district) {
          return this.districtList[i].Wards;
        }
      }
    },
    async fetchData() {
      getAddressDetail().then((response) => {
        this.addressData = response.data;
      });
    },
  },
};
</script>

<style scoped>
.line {
  text-align: center;
}
</style>
