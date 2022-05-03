import ToursService from '@/common/service/tours.api';

import { FETCH_TOUR } from '../type/actions';
import { SET_TOUR } from '../type/mutations';

const state = () => ({
  tour: [],
  reviews: [],
});

const getters = {
  tour: (state) => state.tour,
};

const actions = {
  // fetch detail tour
  [FETCH_TOUR]: async ({ commit }, id) => {
    const response = await ToursService.getDetailTour(id);
    if (response) commit(SET_TOUR, response.data.data);
    console.log(state.tour);
  },
};

const mutations = {
  [SET_TOUR](state, tour) {
    state.tour = tour;
    console.log(tour);
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
