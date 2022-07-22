import { APP_ITEMS_PER_PAGE, APP_FILTER_MAX_PRICE } from '@/common/config';
import { apiService } from './api';

// eslint-disable-next-line func-names
const backendQuerify = function (query) {
  // eslint-disable-next-line prefer-const
  let { destinations, travelStyle, price, rating, duration, sort, page, keyword } = {
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

  if (destinations) destinations = { all: [...destinations] };
  if (travelStyle) travelStyle = { all: [...travelStyle] };

  const limit = APP_ITEMS_PER_PAGE;

  return {
    destinations,
    travelStyle,
    price,
    rating,
    duration,
    sort,
    limit,
    page,
    keyword
  };
};

export default {
  getPlace: (query) => {
    return apiService.get(`place/listing`, backendQuerify(query));
  },

  getDetailPlace: (id) => {
    return apiService.get(`place/detail/${id}`);
  },
};
