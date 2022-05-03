import { UPDATE_ERROR, REMOVE_ERROR } from '../type/mutations';
import { SET_ERROR, CLEAR_ERROR } from '../type/actions';

const state = () => ({
  error: {
    message: undefined,
    type: undefined,
  },
});

const getters = {
  getError: (state) => state.error,
};

const actions = {
  [SET_ERROR]({ commit }, payload) {
    commit(UPDATE_ERROR, payload);
    setTimeout(() => {
      commit(REMOVE_ERROR);
    }, 4000);
    // throw new Error(payload);
  },
  [CLEAR_ERROR]({ commit }) {
    commit(REMOVE_ERROR);
  },
};

const mutations = {
  [UPDATE_ERROR]: (state, payload) => {
    state.error = { message: payload.message, type: payload.type || 'error' };
  },
  [REMOVE_ERROR]: (state) => {
    state.error.message = undefined;
  },
};

export default {
  state,
  actions,
  mutations,
  getters,
};
