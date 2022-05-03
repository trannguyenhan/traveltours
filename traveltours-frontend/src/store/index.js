import Vue from 'vue';
import Vuex from 'vuex';

import tourList from './modules/tourList';
import auth from './modules/auth';
import error from './modules/error';
import featured from './modules/featured';
import tour from './modules/tour';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    tourList,
    auth,
    error,
    featured,
    tour,
  },
});
