<template>
  <div class="my-6">
    <div>Thông tin về tour du lịch!</div>

    <v-row>
      <v-col
        v-for="(point, i) in bookFlexibility"
        :key="i"
        class="d-flex align-center"
        cols="12"
        md="6"
      >
        <TrnBulletPoint
          :icon="point.icon"
          :title="point.title"
          :content="point.content"
        />
      </v-col>
    </v-row>
  </div>
</template>

<script>
  import TrnBulletPoint from '@/components/base/BulletPoint.vue';

  export default {
    components: {
      TrnBulletPoint,
    },
    props: {
      item: {
        type: Object,
        required: true,
      },
    },
    mounted() {
      console.log(this.item);
      this.bookFlexibility = [
        {
          icon: 'mdi-notebook-edit-outline',
          title: 'Phương tiện di chuyển',
          content: this.item.vehicle,
        },
        {
          icon: 'mdi-hospital-box-outline',
          title: 'Số người tham gia',
          content: `Số người đăng ký tối đa là ${this.item.max_slot}, số người đã đăng ký là ${this.item.slot}`,
        },
        {
          icon: 'mdi-star-face',
          title: 'Loại khách sạn',
          content: `Khách sạn ${this.item.hotel_star} sao`,
        },
        {
          icon: 'mdi-halloween',
          title: 'Hướng dẫn viên du lịch',
          content: `${this.item.tour_guide.name}`,
        },
      ]
    },
    data: () => ({
      bookFlexibility: [],
    }),
  };
</script>

<style scoped></style>
