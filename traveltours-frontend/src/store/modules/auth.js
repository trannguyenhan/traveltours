import authsService from '@/common/service/auth.api';
import JwtService from '@/common/jwt';
import {
  SET_AUTH,
  PURGE_AUTH,
  SET_ERROR,
  SET_USER,
} from '@/store/type/mutations.js';
import {
  LOGIN,
  LOGOUT,
  REGISTER,
  CHECK_AUTH,
  UPDATE_USER,
  UPDATE_PASSWORD,
  UPDATE_AVATAR_USER,
} from '@/store/type/actions.js';

const state = {
  user: null,
};

const getters = {
  currentUser: (state) => state.user,
  isAuthenticated: (state) => !!state.user,
};

const actions = {
  // call to api login and save token to localStorage
  [LOGIN]: async ({ commit }, credentials) => {
    const response = await authsService.login(credentials);
    if (response) commit(SET_AUTH, response.data);
  },

  [LOGOUT]({ commit }) {
    commit(PURGE_AUTH);
  },

  async [REGISTER]({ commit }, newUser) {
    const { data } = await authsService.register(newUser);
    commit(SET_AUTH, data.data);
  },

  [CHECK_AUTH]: async ({ commit }) => {
    const token = JwtService.getToken();
    authsService.setHeader(token);

    if (token && !state.user) {
      const response = await authsService.checkAuth();
      if (response) {
        commit(SET_AUTH, { user: response.data.data, token });
      } else JwtService.destroyToken();
    }
  },

  async [UPDATE_USER]({ commit }, updatedUser) {
    try {
      const { data } = await authsService.update(updatedUser);
      commit(SET_USER, data.data);
      return data.data;
    } catch ({ response }) {
      commit(SET_ERROR, response.data.error);
      throw new Error(response.data.error);
    }
  },

  async [UPDATE_AVATAR_USER]({ commit }, formDataUpdateImage) {
    try {
      const { data } = await authsService.updateImage(formDataUpdateImage);
      commit(SET_USER, data.data);
    } catch ({ response }) {
      commit(SET_ERROR, response.data.error);
      throw new Error(response.data.error);
    }
  },

  async [UPDATE_PASSWORD]({ commit }, data) {
    try {
      const response = await authsService.updatePassword(
        data.password,
        data.new_password
      );
      return response;
    } catch ({ response }) {
      commit(SET_ERROR, response.data.error);
      throw new Error(response.data.error);
    }
  },
};

const mutations = {
  [SET_AUTH](state, payload) {
    // get data from payload
    const { user, token } = payload;
    state.user = user; // set user

    if (token) JwtService.saveToken(token);
    authsService.setHeader(token);
  },

  [SET_USER](state, data) {
    state.user = data; // set user
  },

  [PURGE_AUTH](state) {
    state.user = null;

    JwtService.destroyToken();
    authsService.deleteHeader();
  },
};

export default {
  state,
  actions,
  mutations,
  getters,
};
