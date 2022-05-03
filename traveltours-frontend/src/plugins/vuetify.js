import Vue from 'vue';
import Vuetify from 'vuetify/lib';

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
    dark: false,
    themes: {
      light: {
        primary: '#003C71',
        secondary: '#FF9800',
        accent: '#82B1FF',
        error: '#FF5252',
        info: '#56E9FF',
        success: '#4CAF50',
        warning: '#FFC107',
      },
      dark: {
        primary: '#88CBFF',
        secondary: '#FF9800',
        accent: '#82B1FF',
        error: '#ff9800',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FFC107',
      },
    },
  },
});
