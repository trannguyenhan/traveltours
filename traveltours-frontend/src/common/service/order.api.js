import { apiService } from './api';

export default {
  bookTour: (params) => {
    return apiService.postAuth('order/store', params);
  },
  listTour: (query) => {
    return apiService.getAuth('order/listing', query);
  },
};
