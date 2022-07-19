import { APP_ITEMS_PER_PAGE } from '@/common/config';
import { apiService } from './api';

const backendQuerify = function (query) {
  // eslint-disable-next-line prefer-const
  let { tourId, sort, page } = {
    ...query,
  };
  if (tourId) tourId = { all: [...tourId] };

  const limit = APP_ITEMS_PER_PAGE;

  return {
    tourId,
    sort,
    limit,
    page,
  };
};

export default {
  bookTour: (params) => {
    return apiService.postAuth('order/store', params);
  },
  listTour: (id, query) => {
    return apiService.getAuth(`order/all/${id}`, backendQuerify(query));
  },
  checkBookTour: (tourId, userId) => {
    return apiService.get(`order/check-book-tour/${tourId}/${userId}`);
  },
  checkValidCouponCode: (couponCode) => {
    return apiService.get(`coupon/check/${couponCode}`);
  },
};
