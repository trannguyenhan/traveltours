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
      <el-table-column align="center" label="Name" width="200">
        <template slot-scope="scope">
          {{ scope.row.name }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Quận/Huyện" width="200">
        <template slot-scope="scope">
          {{ scope.row.district }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Phường/Xã" width="200">
        <template slot-scope="scope">
          {{ scope.row.ward }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Địa điểm cụ thể" width="200">
        <template slot-scope="scope">
          {{ scope.row.address_detail }}
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
    <el-dialog title="Edit Place" :visible.sync="dialogFormVisible">
      <el-form
        ref="dataForm"
        :model="place"
        label-position="left"
        style="width: 400px; margin-left: 50px"
      >
        <el-form-item label="Tên địa điểm" prop="title">
          <el-input
            style="width: 400px; margin-left: 5px"
            v-model="place.name"
          />
        </el-form-item>
        <el-form-item label="Chọn Tỉnh/Thành phố" prop="title">
          <br />
          <el-select
            v-model="place.province"
            class="m-2"
            placeholder="Tỉnh/Thành phố"
            size="large"
            style="width: 400px"
          >
            <el-option
              v-for="item in addressData"
              :key="item.Name"
              :label="item.Name"
              :value="item.Name"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Chọn Quận/Huyện" prop="title">
          <el-select
            v-model="place.district"
            class="m-2"
            placeholder="Quận/Huyện"
            size="large"
            style="width: 400px"
          >
            <el-option
              v-for="item in listDistrict()"
              :key="item.Id"
              :label="item.Name"
              :value="item.Name"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Chọn Phường/Xã">
          <el-select
            v-model="place.ward"
            class="m-2"
            placeholder="Phường/Xã"
            size="large"
            style="width: 400px"
          >
            <el-option
              v-for="item in listWard()"
              :key="item.Id"
              :label="item.Name"
              :value="item.Name"
            />
          </el-select>
        </el-form-item>

        <el-form-item label="Địa điểm cụ thể" prop="title">
          <el-input
            v-model="place.address_detail"
            autosize
            type="textarea"
            placeholder="Địa điểm cụ thể"
            style="width: 400px"
          />
        </el-form-item>

        <el-form-item label="Mô tả" prop="title">
          <el-input
            v-model="place.description"
            autosize
            type="textarea"
            multiple="multiple"
            placeholder="Mô tả"
            style="width: 400px"
          />
        </el-form-item>
        <input
          id="update-images"
          accept="image/*"
          type="file"
          @change="previewFiles($event)"
          multiple
        />
        <ul>
          <li v-for="image in this.list_images">
            <img style="width: 200px" :src="image" alt="picture text" />
          </li>
        </ul>
        <div class="preview">
          <img id="update-images1" />
        </div>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false"> Cancel </el-button>
        <el-button
          v-if="!dialogCreate"
          type="primary"
          @click="updatePlace(place)"
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
import { getAddressDetail } from "@/api/data";
import { getListPlace, updatePlace, deletePlace } from "@/api/place";
// import "bootstrap/dist/js/bootstrap.js";
// import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
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
      place: null,
      listLoading: true,
      address_data: null,
      districtList: [],
      list_images: [],
      formData: null,
      isUpdateImage: false,
      index: null,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      this.listLoading = true;
      this.formData = new FormData();
      getListPlace().then((response) => {
        this.list = response.data;
        if (this.list.length > 0) {
          this.place = this.list[0];
          this.list_images = this.list[0].images;
          console.log(this.list_images);
        } else {
          this.place = {
            name: "",
            description: "",
          };
        }
        this.listLoading = false;
      });
      getAddressDetail().then((response) => {
        this.addressData = response.data;
      });
    },

    previewFiles(event) {
      this.isUpdateImage = true;
      this.list_images = [];
      let len = event.target.files.length;
      if (len > 0) {
        for (let i = 0; i < len; i++) {
          let src = URL.createObjectURL(event.target.files[i]);
          this.list_images.push(src);
          this.formData.append("images[" + i + "]", event.target.files[i]);
        }
      }
      this.formData.append("name", this.place.name);
      this.formData.append("province", this.place.province);
      this.formData.append("district", this.place.district);
      this.formData.append("address_detail", this.place.address_detail);
      this.formData.append("description", this.place.description);
      this.formData.append("ward", this.place.ward);
      this.formData.append("id", this.place.id);
      console.log(this.formData);
    },

    updatePlace(place) {
      if (this.isUpdateImage) {
        updatePlace(this.formData).then((response) => {
          if (response.code === 0) {
            this.$notify({
              message: "Create success",
              type: "success",
            });
            this.dialogFormVisible = false;
          }
          this.list[this.index].images = response.data.images;
        });
      } else {
        updatePlace(place).then((response) => {
          if (response.code === 0) {
            this.$notify({
              message: "Update success",
              type: "success",
            });
            this.dialogFormVisible = false;
          }
        });
      }
    },

    async handleUpdate(index) {
      this.place = await this.list[index];
      this.list_images = await this.place.images;
      this.dialogFormVisible = true;
      this.dialogCreate = false;
      this.index = index;
      console.log(this.list_images);
    },

    handleDelete(index) {
      this.list_images = this.place.images;
      console.log(this.list_images);
      deletePlace({ id: this.list[index].id }).then((response) => {
        if (response.code === 0) {
          this.$notify({
            message: "Update success",
            type: "success",
          });
          this.fetchData();
        }
      });
    },
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
