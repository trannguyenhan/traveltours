import { apiService } from './api';

export default {
  bookTour: (params) => {
    return apiService.post('order/store', params);
  },
};
