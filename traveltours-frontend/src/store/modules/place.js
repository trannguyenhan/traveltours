import PlacesService from '@/common/service/places.api';

import { FETCH_PLACE } from '../type/actions';
import { SET_PLACE } from '../type/mutations';

const state = () => ({
  place: [],
  reviews: [],
});

const getters = {
  place: (state) => state.place,
};

const actions = {
  // fetch detail tour
  [FETCH_PLACE]: async ({ commit }, id) => {
    const response = await PlacesService.getDetailPlace(id);
    if (response) commit(SET_PLACE, response.data.data);
  },
};

const mutations = {
  [SET_PLACE](state, place) {
    state.place = place;
    console.log(place);
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
