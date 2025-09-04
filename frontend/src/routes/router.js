import { createWebHistory, createRouter } from "vue-router";

import systemRoutes from "./MainRoutes/systemRoutes";

const routes = [
   ...systemRoutes,
   {
      path: '/:pathMatch(.*)*',
      redirect: '/Login',
   }
];

const router = createRouter({
   history: createWebHistory(),
   routes,
});

router.beforeEach((to, from, next) => {
   const token = localStorage.getItem('token');
   if (to.meta.require_auth && !token) {
      next('/Login');
   } else if (to.meta.type === 'system' && token) {
      next('/Home');
   } else {
      next();
   }
});

export default router