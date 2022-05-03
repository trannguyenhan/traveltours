import { FetchApi, apiService } from './api';

export default {
  setHeader(token) {
    FetchApi.defaults.headers.common.Authorization = `Bearer ${token}`;
  },

  deleteHeader() {
    delete FetchApi.defaults.headers.common.Authorization;
  },

  login: (credentials) => apiService.post('auth/login', credentials),
  checkAuth: () => apiService.get('user/profile'),
  register: (newUser) => apiService.post('auth/register', newUser),
  profile: () => apiService.get('user/profile'),
  update: (userUpdate) => apiService.post('user/update', userUpdate),
};
