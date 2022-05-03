import Vue from 'vue';
import { createSimpleTransition } from 'vuetify/lib/components/transitions/createTransition';

import App from './App.vue';
import router from './router';
import vuetify from './plugins/vuetify';

import store from './store';

Vue.config.productionTip = false;

const myTransition = createSimpleTransition('scroll-y-transition');
Vue.component('H3TTransition', myTransition);

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
