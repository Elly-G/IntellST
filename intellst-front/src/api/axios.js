import axios from "axios";

export const Axios = () => {
  const instance = axios.create({
    baseURL: process.env.VUE_APP_BASE_API,
  });

  instance.interceptors.request.use(
    function (config) {
      const token = localStorage.getItem("token");

      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }

      return config;
    },
    function (error) {
      return Promise.reject(error);
    }
  );

  return instance;
};
