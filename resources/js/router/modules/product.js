/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 * File: Product.js
 */

const product = {
  path: '/products',
  component: () => import('@/layout'),
  meta: {
    title: 'product',
    icon: 'menu',
    permissions: ['view menu product'],
  },
  children: [
    {
      path: '/products',
      name: 'Product',
      component: () => import('@/views/product'),
      meta: {
        title: 'product',
        icon: 'list',
        activeMenu: '/products',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'ProductCreate',
      hidden: true,
      component: () => import('@/views/product/Form'),
      meta: {
        activeMenu: '/products',
        title: 'product_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'ProductEdit',
      hidden: true,
      component: () => import('@/views/product/Form'),
      meta: {
        activeMenu: '/products',
        title: 'product_edit',
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
    {
      path: 'sold/:id(\\d+)',
      name: 'ProductSold',
      hidden: true,
      component: () => import('@/views/product/Sold'),
      meta: {
        activeMenu: '/products',
        title: 'product_sold',
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

export default product;
