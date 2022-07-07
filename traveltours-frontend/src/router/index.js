import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '@/store';
import { CHECK_AUTH } from '@/store/type/actions';
import qs from 'qs';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('@/views/Home.vue'),
  },
  {
    name: 'Tours',
    path: '/tours',
    component: () => import('@/views/Tours.vue'),
  },
  {
    name: 'Tour',
    path: '/tour/:id',
    component: () => import('@/views/Tour.vue'),
    props: true,
  },
  {
    name: 'Places',
    path: '/places',
    component: () => import('@/views/Places.vue'),
  },
  {
    name: 'places',
    path: '/place/:id',
    component: () => import('@/views/Place.vue'),
    props: true,
  },
  {
    name: 'User',
    path: '/user',
    component: () => import('@/views/User.vue'),
    meta: {
      requiresAuth: true,
    },
  },
  {
    name: 'UserProfile',
    path: '/user/profile',
    component: () => import('@/views/User.vue'),
    meta: {
      requiresAuth: true,
    },
  },
  {
    name: 'NotFound',
    path: '*',
    component: () => import('@/views/404.vue'),
  },
  {
    name: 'Auth',
    path: '/authentication',
    component: () => import('@/views/Authentication.vue'),
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    }
    return { x: 0, y: 0 };
  },

  stringifyQuery: (query) => {
    const cloneQuery = { ...query };
    Object.keys(cloneQuery).forEach((item) => {
      if (
        Array.isArray(cloneQuery[item]) &&
        cloneQuery[item].length === 1 &&
        !item.includes('[]')
      ) {
        cloneQuery[`${item}[]`] = cloneQuery[item];
        delete cloneQuery[item];
      }
    });

    return qs.stringify(cloneQuery, {
      encode: false,
      indices: false,
      arrayFormat: 'comma',
      addQueryPrefix: true,
    });
  },

  parseQuery: (query) =>
    qs.parse(query, {
      comma: true,
    }),
});

// Ensure checked auth before each page load.
router.beforeEach((to, from, next) => {
  if (store.getters.isAuthenticated) {
    next();
    return;
  }

  // check auth before first load or page reload to get token to get the user data
  store.dispatch(CHECK_AUTH).then(() => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
      if (store.getters.isAuthenticated) {
        next();
        return;
      }
      next('/authentication');
    } else {
      next();
    }
  });
});

export default router;
