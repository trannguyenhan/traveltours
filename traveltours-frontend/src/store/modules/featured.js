export default {
  state: {
    featuredTours: [
      {
        src:
          'https://cdn1.ivivu.com/iVivu/2020/05/05/10/t-the-anam-nha-trang.png',
        text: 'Nghỉ Dưỡng Nha Trang',
        link: 'nhatrang',
      },
      {
        src: 'https://saigontourist.net/uploads/sliders/Slider-Phong-KS.jpg',
        text: 'Escape for a weekend from Las Vegas',
        link: 'phong-ks',
      },
      {
        src: 'https://saigontourist.net/uploads/sliders/ThueXe_1030925341.jpg',
        text: 'Breathe in fresh mountain air this spring',
        link: 'Thuexe',
      },
      {
        src:
          'https://saigontourist.net/uploads/sliders/Slider-Maldives_389529229.jpg',
        text: 'Find hidden gems in your own city',
        link: 'Maldives',
      },
      {
        src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
        text: 'Hold your spot for Keukenhof Gardens',
        link: 'planet',
      },
    ],
  },
  getters: {
    getFeaturedTours: (state) => state.featuredTours,
  },
  mutations: {
    updateValue(state, payload) {
      state.value = payload;
    },
  },
  actions: {
    updateValue({ commit }, payload) {
      commit('updateValue', payload);
    },
  },
};
