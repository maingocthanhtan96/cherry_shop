/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-05 21:05:22
 * File: ProductDetail.js
 */

const productDetail = {
  path: '/product-details',
  component: () => import('@/layout'),
  meta: {
    title: 'product_detail',
    icon: 'menu',
    permissions: ['view menu product_detail'],
  },
  hidden: true,
  children: [
    {
      path: '/product-details',
      name: 'ProductDetail',
      component: () => import('@/views/product-detail'),
      meta: {
        title: 'product_detail',
        icon: 'list',
        activeMenu: '/product-details',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'ProductDetailCreate',
      hidden: true,
      component: () => import('@/views/product-detail/Form'),
      meta: {
        activeMenu: '/product-details',
        title: 'product_detail_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'ProductDetailEdit',
      hidden: true,
      component: () => import('@/views/product-detail/Form'),
      meta: {
        activeMenu: '/product-details',
        title: 'product_detail_edit',
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

export default productDetail;
