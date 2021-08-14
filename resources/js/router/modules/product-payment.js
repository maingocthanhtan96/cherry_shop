/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:58:19
 * File: ProductPayment.js
 */

const productPayment = {
  path: '/product-payments',
  component: () => import('@/layout'),
  meta: {
    title: 'product_payment',
    icon: 'atm',
    permissions: ['view menu product_payment'],
  },
  children: [
    {
      path: '/product-payments',
      name: 'ProductPayment',
      component: () => import('@/views/product-payment'),
      meta: {
        title: 'product_payment',
        icon: 'list',
        activeMenu: '/product-payments',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'ProductPaymentCreate',
      hidden: true,
      component: () => import('@/views/product-payment/Form'),
      meta: {
        activeMenu: '/product-payments',
        title: 'product_payment_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'ProductPaymentEdit',
      hidden: true,
      component: () => import('@/views/product-payment/Form'),
      meta: {
        activeMenu: '/product-payments',
        title: 'product_payment_edit',
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

export default productPayment;
