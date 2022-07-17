<template>
  <div v-if="currentUser" class="user-profile">
    <v-card class="mx-auto">
      <v-navigation-drawer
        v-if="$vuetify.breakpoint.mdAndUp"
        v-model="drawer"
        :mini-variant="mini"
        mobile-breakpoint="960"
        dark
        permanent
      >
        <template v-slot:img>
          <v-img
            src="https://demos.creative-tim.com/material-dashboard-pro/assets/img/sidebar-1.jpg"
            gradient="360deg,rgba(25,32,72,.2), rgba(25,32,72,0.9)"
            height="100%"
          />
        </template>

        <v-row>
          <v-col align="center">
            <div v-if="!mini">
              <v-avatar class="my-4" size="150">
                <img :src="currentUser.avatar" alt="" />
              </v-avatar>
              <p class="white--text text-h5">{{ currentUser.username }}</p>
              <p class="white--text">{{ currentUser.email }}</p>
            </div>
            <v-avatar v-else>
              <img :src="currentUser.avatar" alt="" />
            </v-avatar>
          </v-col>
        </v-row>

        <v-divider class="mb-2" />

        <v-list>
          <v-list-item
            v-for="(item, i) in items"
            :key="i"
            link
            @click="changeItem(item)"
          >
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <template v-slot:append>
          <div class="pa-2">
            <v-btn block @click="logout()"> Logout </v-btn>
          </div>
        </template>
      </v-navigation-drawer>
    </v-card>
    <div class="profile-information">
      <div v-if="item === 1">
        <v-text-field
          v-model="currentUser.username"
          label="Username"
          :rules="rules"
          hide-details="auto"
          disabled
        />
        <v-text-field
          v-model="currentUser.email"
          label="Email"
          :rules="rules"
          hide-details="auto"
          disabled
        />
        <v-text-field
          v-model="currentUser.name"
          label="Tên"
          :rules="rules"
          hide-details="auto"
        />
        <br />
        <v-btn depressed color="primary" @click="updateProfile()">
          Cập nhật
        </v-btn>
        <br /><br />
        <input id="update-image" type="file" />
        <v-btn depressed color="primary" @click="updateAvatarProfile()">
          Cập nhật ảnh đại diện
        </v-btn>
      </div>
      <div v-if="item === 2" style="width: 150%">
        <v-data-table
          :headers="headers"
          :items="orderInfo"
          :items-per-page="5"
          class="elevation-1"
        />
      </div>
      <div v-if="item === 3">
        <v-text-field v-model="password" label="Mật khẩu" hide-details="auto" />
        <v-text-field
          v-model="newPassword"
          label="Nhập lại mật khẩu"
          hide-details="auto"
        />
        <br />
        <v-btn depressed color="primary" @click="updatePassword()">
          Cập nhật mật khẩu
        </v-btn>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex';
  import orderApi from '@/common/service/order.api';
  import {
    UPDATE_USER,
    LOGOUT,
    UPDATE_AVATAR_USER,
    UPDATE_PASSWORD,
  } from '@/store/type/actions';
  import Swal from 'sweetalert2';

  export default {
    data: () => ({
      drawer: true,
      mini: false,
      item: 2,
      items: [
        { title: 'My Profile', icon: 'mdi-heart', id: 1 },
        { title: 'My Tours', icon: 'mdi-star', id: 2 },
        { title: 'Password', icon: 'mdi-lock', id: 3 },
      ],
      rules: [
        (value) => !!value || 'Required.',
        (value) => (value && value.length >= 3) || 'Min 3 characters',
      ],
      password: '',
      newPassword: '',
      orderInfo: [],
      headers: [
        {
          text: 'Mã đặt hàng',
          align: 'start',
          value: 'id',
        },
        {
          text: 'Tên chuyến đi',
          value: 'tour.name',
          sortable: false,
        },
        {
          text: 'Số lượng người lớn',
          value: 'adult_count',
        },
        { text: 'Số lượng trẻ em', value: 'child_count' },
        {
          text: 'Phương thức thanh toán',
          value: 'payment_method',
          sortable: false,
        },
        { text: 'Tổng tiền', value: 'total_price' },
        { text: 'Trạng thái', value: 'status', sortable: false },
      ],
    }),
    computed: {
      ...mapGetters(['currentUser']),
    },
    mounted() {
      this.listOrder();
    },

    methods: {
      updateProfile() {
        this.$store.dispatch(UPDATE_USER, this.currentUser);
      },

      async listOrder() {
        const resp = await orderApi.listTour(this.currentUser.id);
        this.orderInfo = resp.data.data;
        console.log(resp.data.data);
      },
      updateAvatarProfile() {
        const formData = new FormData();
        const newAvatar = document.querySelector('#update-image');
        formData.append('avatar', newAvatar.files[0]);
        this.$store.dispatch(UPDATE_AVATAR_USER, formData);
      },

      changeItem(item) {
        this.item = item.id;
        if (item.id === 2) {
          this.listOrder();
        }
      },

      logout() {
        this.$store.dispatch(LOGOUT);
        this.$router.go();
      },
      updatePassword() {
        this.$store
          .dispatch(UPDATE_PASSWORD, {
            password: this.password,
            new_password: this.newPassword,
          })
          .then((response) => {
            if (response.status === 200) {
              Swal.fire({
                text: 'Cập nhật mật khẩu thành công',
                icon: 'success',
              });
            }
          })
          .catch(() => {
            Swal.fire({
              text: 'Cập nhật mật khẩu thất bại',
              icon: 'error',
            });
          });

        this.password = '';
        this.newPassword = '';
      },
    },
  };
</script>

<style scoped>
  .user-profile {
    max-width: 960px;
    margin: auto;
    display: flex;
    justify-content: space-between;
  }

  .profile-information {
    margin-top: 5%;
    width: 60%;
  }
</style>
