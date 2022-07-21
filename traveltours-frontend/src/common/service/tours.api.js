import { APP_ITEMS_PER_PAGE, APP_FILTER_MAX_PRICE } from '@/common/config';
import { apiService } from './api';

// eslint-disable-next-line func-names
const backendQuerify = function (query) {
  // eslint-disable-next-line prefer-const
  let { places, categories, price, rating, duration, sort, page, keyword } = {
    ...query,
  };

  if (price)
    price = {
      gte: +price[0] || undefined,
      lte: +price[1] !== APP_FILTER_MAX_PRICE ? price[1] : undefined,
    };

  if (rating) rating = { gte: rating };

  if (duration)
    duration = {
      gte: +duration[0] || undefined,
      lte: +duration[1] || undefined,
    };

  if (places) places = { all: [...places] };
  if (categories) categories = { all: [...categories] };

  const limit = APP_ITEMS_PER_PAGE;

  return {
    places,
    categories,
    price,
    rating,
    duration,
    sort,
    limit,
    page,
    keyword,
  };
};

export default {
  getTour: (query) => {
    return apiService.get(`tour/listing`, backendQuerify(query));
  },

  getDetailTour: (id) => {
    return apiService.get(`tour/detail/${id}`);
  },
};
