import { apiService } from './api';

export default {
  submitComment: (params) => {
    return apiService.postAuth('review/store', params);
  },
};
