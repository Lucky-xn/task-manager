import { ref } from 'vue';
import { jwtDecode } from 'jwt-decode';
import { getValidToken, removeToken } from './Auth';

const user = ref(null);

export function useAuth() {
   const logout = () => {
      removeToken();
      user.value = null;
   }

   const loadUserFromToken = () => {
      const token = getValidToken();
      if (!token) {
         user.value = null;
         return null;
      }
      try {
         const decoded = jwtDecode(token);
         user.value = user.value = {
        first_name: decoded.first_name,
        last_name: decoded.last_name,
        email: decoded.email
      };
         return decoded;
      } catch (e) {
         console.error("Invalid token:", e);
         logout();
         return null;
      }
   }
   
   loadUserFromToken();

   return {
      user,
      loadUserFromToken,
      logout
   }
}
