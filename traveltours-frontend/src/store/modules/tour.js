import ToursService from '@/common/service/tours.api';

import { FETCH_TOUR } from '../type/actions';
import { SET_TOUR } from '../type/mutations';

const state = () => ({
  tour: [],
  reviews: [],
  item_id_2: 1,
});

const getters = {
  tour: (state) => state.tour,
  item_id_2: (state) => state.item_id_2,
};

const actions = {
  // fetch detail tour
  [FETCH_TOUR]: async ({ commit }, id) => {
    const response = await ToursService.getDetailTour(id);
    if (response) commit(SET_TOUR, response.data.data);
    console.log(state.tour);
  },
  checkItemId2 ({ commit }, val)  {
    commit('checkItemId2', val);
  }
};

const mutations = {
  [SET_TOUR](state, tour) {
    state.tour = tour;
    console.log(tour);
  },
  checkItemId2(state, val) {
    state.item_id_2 = val;
  }
};

export default {
  state,
  getters,
  actions,
  mutations,
};
