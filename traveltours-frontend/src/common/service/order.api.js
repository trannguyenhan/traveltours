import { apiService } from './api';
import {APP_FILTER_MAX_PRICE, APP_ITEMS_PER_PAGE} from "@/common/config";

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
  listTour: (query) => {
    return apiService.getAuth('order/listing', backendQuerify(query));
  },
};
