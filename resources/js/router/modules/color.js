/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:55:13
 * File: Color.js
 */

const color = {
  path: '/colors',
  component: () => import('@/layout'),
  meta: {
    title: 'color',
    icon: 'colors',
    permissions: ['view menu color'],
  },
  children: [
    {
      path: '/colors',
      name: 'Color',
      component: () => import('@/views/color'),
      meta: {
        title: 'color',
        icon: 'list',
        activeMenu: '/colors',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'ColorCreate',
      hidden: true,
      component: () => import('@/views/color/Form'),
      meta: {
        activeMenu: '/colors',
        title: 'color_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'ColorEdit',
      hidden: true,
      component: () => import('@/views/color/Form'),
      meta: {
        activeMenu: '/colors',
        title: 'color_edit',
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

export default color;
