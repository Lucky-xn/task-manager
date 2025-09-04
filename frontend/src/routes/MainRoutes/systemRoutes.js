import HomePage from "../../components/HomePage.vue";
import Login from "../../components/Login/Login.vue";
import AccontRegister from "../../components/Login/Register/AccontRegister.vue";

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