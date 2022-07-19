import { apiService } from './api';

export default {
  getListCategory: () => {
    return apiService.get('category/listing');
  },
};
