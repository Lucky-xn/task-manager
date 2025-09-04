import HomePage from "@/Views/HomePage.vue";
import Login from "@/Views/Login/UserLogin.vue";
import AccontRegister from "@/Views/Login/Register/AccontRegister.vue";

export default [
   {
      path: '/Home',
      component: HomePage,
      meta: {
         type: 'public',
         require_auth: true,
      }
   },
   {
      path: '/Login',
      component: Login,
      meta: {
         type: 'system',
         require_auth: false,
      }
   },
   {
      path: '/register',
      component: AccontRegister,
      meta: {
         type: 'system',
         require_auth: false
      }
   }
]