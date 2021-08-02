/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:02:10
 * File: Member.js
 */

const member = {
  path: '/members',
  component: () => import('@/layout'),
  meta: {
    title: 'member',
    icon: 'menu',
    permissions: ['view menu member'],
  },
  children: [
    {
      path: '/members',
      name: 'Member',
      component: () => import('@/views/member'),
      meta: {
        title: 'member',
        icon: 'list',
        activeMenu: '/members',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'MemberCreate',
      hidden: true,
      component: () => import('@/views/member/Form'),
      meta: {
        activeMenu: '/members',
        title: 'member_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'MemberEdit',
      hidden: true,
      component: () => import('@/views/member/Form'),
      meta: {
        activeMenu: '/members',
        title: 'member_edit',
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

export default member;
