/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:00:29
 * File: ProductReject.js
 */

const productReject = {
  path: '/product-rejects',
  component: () => import('@/layout'),
  meta: {
    title: 'product_reject',
    icon: 'menu',
    permissions: ['view menu product_reject'],
  },
  children: [
    {
      path: '/product-rejects',
      name: 'ProductReject',
      component: () => import('@/views/product-reject'),
      meta: {
        title: 'product_reject',
        icon: 'list',
        activeMenu: '/product-rejects',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'ProductRejectCreate',
      hidden: true,
      component: () => import('@/views/product-reject/Form'),
      meta: {
        activeMenu: '/product-rejects',
        title: 'product_reject_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'ProductRejectEdit',
      hidden: true,
      component: () => import('@/views/product-reject/Form'),
      meta: {
        activeMenu: '/product-rejects',
        title: 'product_reject_edit',
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

export default productReject;
