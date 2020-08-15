import axios from "axios";

axios.defaults.baseURL = process.env.VUE_APP_BASE_API;
axios.defaults.headers.common = {
  Authorization: `Bearer ${localStorage.getItem("token")}`,
};
export default axios;
