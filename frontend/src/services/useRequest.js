import axios from 'axios';
import { useAuth, getValidToken } from './useAuth';

import { ref } from 'vue';

const { logout } = useAuth();

const api = axios.create({
   baseURL: import.meta.env.VITE_API_URL,
   timeout: 50000,
   headers: {
      'Content-Type': 'application/json'
   }
});

export { api };

api.interceptors.request.use(
   (config) => {
      const token = getValidToken();
      if (token) {
         config.headers['Authorization'] = `Bearer ${token}`;
      }
      return config;
   },
   error => Promise.reject(error),
)

api.interceptors.response.use(
   (response) => response,
   (error) => {
      if (error.response && error.response?.status === 401) {
         logout();
      }
      return Promise.reject(error);
   }
)

export function useRequest(url, method = 'GET') {
   const dados = ref(null)
   const apiUrl = url;

   const loading = ref(false);

   const makeRequest = async (params = {}, newUrl = apiUrl) => {
      loading.value = true;
      try {
         const response = await api[method.toLowerCase()](newUrl, params);
         dados.value = response.data;
      } catch (error) {
         console.error(error);
      } finally {
         loading.value = false;
      }
   }

   return { dados, makeRequest, loading };
}