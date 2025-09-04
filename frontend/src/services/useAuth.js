import { ref } from 'vue';
import { jwtDecode } from 'jwt-decode';

const user = ref(null);

const isTokenExpired = (token) => {
   try {
      const {exp} = jwtDecode(token);
      if (!exp) return true;
      return Date.now() >= exp * 1000;
   } catch {
      return true;
   }
}

export const getValidToken = () => {
   const token = getToken();
   if (!token || isTokenExpired(token)) {
      removeToken();
      return null;
   }
   return token;
}

export const setToken = (token) => {
   localStorage.setItem('token', token);
};

export const getToken = () => {
   return localStorage.getItem('token');
};

export const removeToken = () => {
   localStorage.removeItem('token');
};

export function useAuth() {
   const logout = () => {
      removeToken();
      user.value = null;
      window.location.reload();
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
