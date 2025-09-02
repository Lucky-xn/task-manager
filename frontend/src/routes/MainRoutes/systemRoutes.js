import HomePage from "../../components/HomePage.vue";
import Login from "../../components/Login/Login.vue";
import AccontRegister from "../../components/Login/Register/AccontRegister.vue";

export default [
   {
      path: '/home_page',
      component: HomePage,
      meta: {
         type: 'public'
      }
   },
   {
      path: '/Login',
      component: Login,
      meta: {
         type: 'system'
      }
   },
   {
      path: '/register',
      component: AccontRegister,
      meta: {
         type: 'system'
      }
   }
]