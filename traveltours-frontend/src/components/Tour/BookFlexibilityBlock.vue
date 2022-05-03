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
          title: 'Change dates',
          content: 'Choose new departure dates if your plans change.',
        },
        {
          icon: 'mdi-map-marker-check-outline',
          title: 'Choose a different tour',
          content:
            'Change to a different tour if you want something different.',
        },
        {
          icon: 'mdi-credit-card-check-outline',
          title: 'Get credit if plans change',
          content:
            'Get credit for future trips if you need more time to decide.',
        },
        {
          icon: 'mdi-headset',
          title: '24/7 Support',
          content: 'Reach out to us anytime via online chat, phone or email.',
        },
      ],
    }),
  };
</script>

<style scoped></style>
