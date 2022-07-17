import axios from 'axios';
import qs from 'qs';
import { getToken } from '@/common/jwt';

import errorResponseHandler from '@/common/service/errorHandler.api.js';
import { APP_API_URL, APP_TIME_OUT } from '@/common/config';

export const FetchApi = axios.create({
  baseURL: APP_API_URL,
  timeout: APP_TIME_OUT,
});

const token = getToken();
export const FetchApiAuth = axios.create({
  baseURL: APP_API_URL,
  timeout: APP_TIME_OUT,
  headers: { Authorization: `Bearer ${token}` },
});

// apply interceptor on response
// turn it off by pass the {errorHandle: false}
FetchApi.interceptors.response.use(
  (response) => response,
  errorResponseHandler
);

// Vue.prototype.$http = TrnApi;

const queryStringify = (query) =>
  qs.stringify(query, {
    encode: false,
    indices: false,
    arrayFormat: 'comma',
    addQueryPrefix: true,
  });

export const apiService = {
  get: (resource, query) => FetchApi.get(resource + queryStringify(query)),
  post: (resource, params) => FetchApi.post(`${resource}`, params),
  postAuth: (resource, params) => FetchApiAuth.post(`${resource}`, params),
  getAuth: (resource, query) =>
    FetchApiAuth.get(resource + queryStringify(query)),
};

export const TagsService = {
  get() {
    return apiService.get('tags');
  },
};

export const CommentsService = {
  get(slug) {
    if (typeof slug !== 'string') {
      throw new Error(
        '[traveltours] CommentsService.get() article slug required to fetch comments'
      );
    }
    return apiService.get('articles', `${slug}/comments`);
  },

  post(slug, payload) {
    return apiService.post(`articles/${slug}/comments`, {
      comment: { body: payload },
    });
  },

  destroy(slug, commentId) {
    return apiService.delete(`articles/${slug}/comments/${commentId}`);
  },
};

export const FavoriteService = {
  add(slug) {
    return apiService.post(`articles/${slug}/favorite`);
  },
  remove(slug) {
    return apiService.delete(`articles/${slug}/favorite`);
  },
};
