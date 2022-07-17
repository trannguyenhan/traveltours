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
  update: (userUpdate) => apiService.post('user/update', userUpdate),
  updateImage: (formDataUpdateImage) =>
    apiService.post('user/update-image', formDataUpdateImage),
  updatePassword: (oldPassword, newPassword) =>
    apiService.post('user/change-password', {
      password: oldPassword,
      new_password: newPassword,
      password_confirmation: newPassword,
    }),
};
