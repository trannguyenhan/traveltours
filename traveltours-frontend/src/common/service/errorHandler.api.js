import store from '@/store';
import { SET_ERROR } from '@/store/type/actions';

// eslint-disable-next-line consistent-return
export default function errorResponseHandler(error) {
  if (
    Object.prototype.hasOwnProperty.call(error.config, 'errorHandle') &&
    error.config.errorHandle === false
  ) {
    return Promise.reject(error);
  }

  if (error.response) {
    const errorMessage =
      error.response.data.message || 'Sorry! Something went wrong!';

    store.dispatch(SET_ERROR, {
      message: `[Tourino]: ${errorMessage}`,
    });
  } else if (error.request) {
    store.dispatch(SET_ERROR, {
      message: '[Tourino]: Network Error! Please try again later!',
    });
  } else {
    // Something happened in setting up the request that triggered an Error
    console.log('Error', error.message);
  }
}
