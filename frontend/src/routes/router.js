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

export default router