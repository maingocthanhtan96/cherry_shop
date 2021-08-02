/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:55:43
 * File: Size.js
 */

const size = {
  path: '/sizes',
  component: () => import('@/layout'),
  meta: {
    title: 'size',
    icon: 'menu',
    permissions: ['view menu size'],
  },
  children: [
    {
      path: '/sizes',
      name: 'Size',
      component: () => import('@/views/size'),
      meta: {
        title: 'size',
        icon: 'list',
        activeMenu: '/sizes',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'SizeCreate',
      hidden: true,
      component: () => import('@/views/size/Form'),
      meta: {
        activeMenu: '/sizes',
        title: 'size_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'SizeEdit',
      hidden: true,
      component: () => import('@/views/size/Form'),
      meta: {
        activeMenu: '/sizes',
        title: 'size_edit',
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

export default size;
