<template>
  <div class="my-6">
    <div>Have you considered booking this tour privately? Contact Us now!</div>

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
          icon: 'mdi-notebook-edit-outline',
          title: 'Personalise your trip',
          content:
            'Make changes to the itinerary, accommodation, or transport method.',
        },
        {
          icon: 'mdi-hospital-box-outline',
          title: 'Increased safety during COVID',
          content:
            'Spend the majority of time amongst your group to reduce exposure with others.',
        },
        {
          icon: 'mdi-star-face',
          title: 'Travel more exclusively',
          content:
            'Your tour guide can focus all their attention on your group.',
        },
        {
          icon: 'mdi-halloween',
          title: 'Travel for a special occasion',
          content:
            'Celebrate an important event by only travelling with your friends or family.',
        },
      ],
    }),
  };
</script>

<style scoped></style>
