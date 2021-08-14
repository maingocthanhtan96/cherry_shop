const dashboard = {
  path: '/dashboard',
  component: () => import('@/layout'),
  meta: {
    title: 'dashboard',
    icon: 'dashboard',
  },
  hidden: true,
  children: [
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: () => import('@/views/dashboard'),
      meta: {
        title: 'dashboard',
        icon: 'dashboard',
      },
    },
  ],
};

export default dashboard;
