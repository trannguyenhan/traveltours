import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

/* Layout */
import Layout from '@/layout'

/**
 * Note: sub-menu only appear when route children.length >= 1
 * Detail see: https://panjiachen.github.io/vue-element-admin-site/guide/essentials/router-and-nav.html
 *
 * hidden: true                   if set true, item will not show in the sidebar(default is false)
 * alwaysShow: true               if set true, will always show the root menu
 *                                if not set alwaysShow, when item has more than one children route,
 *                                it will becomes nested mode, otherwise not show the root menu
 * redirect: noRedirect           if set noRedirect will no redirect in the breadcrumb
 * name:'router-name'             the name is used by <keep-alive> (must set!!!)
 * meta : {
    roles: ['admin','editor']    control the page roles (you can set multiple roles)
    title: 'title'               the name show in sidebar and breadcrumb (recommend set)
    icon: 'svg-name'/'el-icon-x' the icon show in the sidebar
    breadcrumb: false            if set false, the item will hidden in breadcrumb(default is true)
    activeMenu: '/example/list'  if set path, the sidebar will highlight the path you set
  }
 */

/**
 * constantRoutes
 * a base page that does not have permission requirements
 * all roles can be accessed
 */
export const constantRoutes = [
  {
    path: '/login',
    component: () => import('@/views/login/index'),
    hidden: true
  },

  {
    path: '/404',
    component: () => import('@/views/404'),
    hidden: true
  },

  {
    path: '/',
    component: Layout,
    redirect: '/dashboard',
    children: [{
      path: 'dashboard',
      name: 'Dashboard',
      component: () => import('@/views/dashboard/index'),
      meta: { title: 'Dashboard', icon: 'dashboard' }
    }]
  },

  {
    path: '/tour',
    component: Layout,
    redirect: '/tour/categories',
    name: 'Tour Management',
    meta: { title: 'Tour Management', icon: 'el-icon-location' },
    children: [
      {
        path: 'listing',
        name: 'Tour',
        component: () => import('@/views/tour/tour'),
        meta: { title: 'Tour', icon: 'table' }
      },
      {
        path: 'coupon',
        name: 'Coupon',
        component: () => import('@/views/coupon/coupon'),
        meta: { title: 'Coupon', icon: 'table' }
      },
      {
        path: 'categories',
        name: 'Categories',
        component: () => import('@/views/tour/category'),
        meta: { title: 'Category', icon: 'table' }
      },
      {
        path: 'tour-guides',
        name: 'Tour Guides',
        component: () => import('@/views/tour/tour_guide'),
        meta: { title: 'Tour Guides', icon: 'table' }
      },
      {
        path: 'add',
        name: 'Add Tour',
        component: () => import('@/views/tour/add_tour'),
        meta: { title: 'Add Tour', icon: 'form' }
      }
    ]
  },

  {
    path: '/place',
    component: Layout,
    // redirect: '/tour/categories',
    name: 'Place Management',
    meta: { title: 'Place Management', icon: 'el-icon-location' },
    children: [
      {
        path: 'listing',
        name: 'place',
        component: () => import('@/views/place/place'),
        meta: { title: 'Place', icon: 'table' }
      },

      {
        path: 'add',
        name: 'Add Place',
        component: () => import('@/views/place/add_place'),
        meta: { title: 'Add Place', icon: 'form' }
      },

    ]
  },
  {
    path: '/',
    component: Layout,
    redirect: '/order',
    children: [{
      path: 'order',
      name: 'order',
      component: () => import('@/views/order/order'),
      meta: { title: 'Order', icon: 'dashboard' }
    }]
  },

  {
    path: '/user',
    component: Layout,
    redirect: '/user/user',
    name: 'User Management',
    meta: { title: 'User Management', icon: 'el-icon-s-help' },
    children: [
      {
        path: 'add',
        name: 'Add User',
        component: () => import('@/views/user/add_user'),
        meta: { title: 'Add User', icon: 'form' }
      },
      {
        path: 'listing',
        name: 'User',
        component: () => import('@/views/user/user'),
        meta: { title: 'User', icon: 'table' }
      },
      {
        path: 'role',
        name: 'Role',
        component: () => import('@/views/user/role'),
        meta: { title: 'Role', icon: 'tree' }
      }
    ]
  },

  // {
  //   path: '/example',
  //   component: Layout,
  //   redirect: '/example/table',
  //   name: 'Example',
  //   meta: { title: 'Example', icon: 'el-icon-s-help' },
  //   children: [
  //     {
  //       path: 'table',
  //       name: 'Table',
  //       component: () => import('@/views/table/index'),
  //       meta: { title: 'Table', icon: 'table' }
  //     },
  //     {
  //       path: 'tree',
  //       name: 'Tree',
  //       component: () => import('@/views/tree/index'),
  //       meta: { title: 'Tree', icon: 'tree' }
  //     }
  //   ]
  // },
  //
  // {
  //   path: '/form',
  //   component: Layout,
  //   children: [
  //     {
  //       path: 'index',
  //       name: 'Form',
  //       component: () => import('@/views/form/index'),
  //       meta: { title: 'Form', icon: 'form' }
  //     }
  //   ]
  // },

  {
    path: 'view-website',
    component: Layout,
    children: [
      {
        path: 'http://localhost:8080/',
        meta: { title: 'View website', icon: 'link' }
      }
    ]
  },

  // 404 page must be placed at the end !!!
  { path: '*', redirect: '/404', hidden: true }
]

const createRouter = () => new Router({
  // mode: 'history', // require service support
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRoutes
})

const router = createRouter()

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
  const newRouter = createRouter()
  router.matcher = newRouter.matcher // reset router
}

export default router
