import { FETCH_CATEGORIES, SET_CATEGORIES } from '@/store/type/actions';
import CategoryService from '@/common/service/category.js';

const state = () => ({
  categories: [],
});

const getters = {
  categories: (state) => state.categories,
};

const actions = {
  // fetch all tour
  [FETCH_CATEGORIES]: async ({ commit }) => {
    const response = await CategoryService.getListCategory();
    console.log(response);
    if (response) commit(SET_CATEGORIES, response.data);
  },
};

const mutations = {
  [SET_CATEGORIES](state, data) {
    state.categories = data.data;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
