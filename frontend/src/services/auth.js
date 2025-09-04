import {jwtDecode} from "jwt-decode";

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