import PlacesService from '@/common/service/places.api';

import { FETCH_PLACES } from '../type/actions';
import { FETCH_START, FETCH_PLACE_END } from '../type/mutations';

const state = () => ({
  places: [],
  totalPlace: undefined,
  returnedPlace: undefined,
  isPlacesLoading: true,
});

const getters = {
  places: (state) => state.places,
  totalPlace: (state) => state.totalPlace,
  returnedPlace: (state) => state.returnedPlace,

  isPlacesLoading: (state) => state.isPlacesLoading,
};

const actions = {
  // fetch all tour
  [FETCH_PLACES]: async ({ commit }, query) => {
    commit(FETCH_START);
    const response = await PlacesService.getPlace(query);
    console.log(response);

    // set state: tours, totalPlace
    if (response) commit(FETCH_PLACE_END, response.data);
  },
};

const mutations = {
  [FETCH_START](state) {
    state.isPlacesLoading = true;
  },

  [FETCH_PLACE_END](state, response) {
    const totalLocal = response.total;

    state.places = response.data;
    state.totalPlace = totalLocal;
    state.returnedPlace = response.data.length;
    state.isPlacesLoading = false;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
