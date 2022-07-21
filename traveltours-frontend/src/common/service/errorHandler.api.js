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
    const errorsObject = error.response.data.errors;

    let errorMessage = '';
    // eslint-disable-next-line guard-for-in,no-restricted-syntax
    for (const obj in errorsObject) {
      errorMessage += errorsObject[obj][0];
    }

    if (errorMessage === '') {
      errorMessage = error.response.data.error;
      if (errorMessage !== 'Unauthorized') {
        errorMessage = 'Sorry! Something went wrong!';
      }
    }

    store.dispatch(SET_ERROR, {
      message: `[Errors]: ${errorMessage}`,
    });
  } else if (error.request) {
    store.dispatch(SET_ERROR, {
      message: '[Errors]: Network Error! Please try again later!',
    });
  } else {
    // Something happened in setting up the request that triggered an Error
    console.log('Error', error.message);
  }
}
