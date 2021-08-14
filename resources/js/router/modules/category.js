/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:49:15
 * File: Category.js
 */

const category = {
  path: '/categories',
  component: () => import('@/layout'),
  meta: {
    title: 'category',
    icon: 'category',
    permissions: ['view menu category'],
  },
  children: [
    {
      path: '/categories',
      name: 'Category',
      component: () => import('@/views/category'),
      meta: {
        title: 'category',
        icon: 'list',
        activeMenu: '/categories',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'CategoryCreate',
      hidden: true,
      component: () => import('@/views/category/Form'),
      meta: {
        activeMenu: '/categories',
        title: 'category_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'CategoryEdit',
      hidden: true,
      component: () => import('@/views/category/Form'),
      meta: {
        activeMenu: '/categories',
        title: 'category_edit',
        permissions: ['edit'],
        icon: 'edit',
      },
      props: route => {
        return {
          ...route,
          props: true,
        };
      },
    },
  ],
};

export default category;
