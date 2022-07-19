<template>
  <div>
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
    data: () => ({
      bookFlexibility: [
        {
          icon: 'mdi-calendar-clock',
          title: 'Lịch trình',
          content: 'Lịch trình cụ thể, rõ ràng nơi đến, nơi ở, khách sạn.',
        },
        {
          icon: 'mdi-map-marker-check-outline',
          title: 'Chọn chuyến tham quan khác',
          content:
            'Đổi sang một chuyến tham quan khác nếu bạn muốn điều gì đó khác biệt.',
        },
        {
          icon: 'mdi-credit-card-check-outline',
          title: 'Thanh toán',
          content: 'Thanh toán linh hoạt',
        },
        {
          icon: 'mdi-headset',
          title: 'Hỗ trợ 24/7',
          content:
            'Gọi điện vào đường dây nóng hoặc gửi email cho chúng tôi nếu bạn muốn hỗ trợ.',
        },
      ],
    }),
  };
</script>

<style scoped></style>
