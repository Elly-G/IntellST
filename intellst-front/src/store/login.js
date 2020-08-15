import Axios from "../api/axios.js";
import router from "../router";

const login = {
  namespaced: true,
  state: () => ({
    userToken: null,
    allData: null,
    status: null,
    error: null,
    userData: null,
  }),
  mutations: {
    setToken(state, payload) {
      state.userToken = payload;
    },

    removeToken(state) {
      state.userToken = null;
    },

    setStatus(state, payload) {
      state.status = payload;
    },

    setError(state, payload) {
      state.error = payload;
    },

    setUser(state, payload) {
      state.userData = payload;
    },

    removeUser(state) {
      state.userData = null;
    },
  },
  actions: {
    signInAction({ commit, dispatch }, payload) {
      Axios.post("login_check", {
        username: payload.username,
        password: payload.password,
      })
        .then(({ data: { token } }) => {
          commit("setToken", token);
          commit("setStatus", "success");

          localStorage.setItem("token", token);

          router.push("/");
          dispatch(
            "snackbar/showSnack",
            {
              message: "You've succesfully logged in!",
              type: "success",
            },
            { root: true }
          );
        })
        .catch((e) => {
          commit("setError", e);
        });
    },
    getUserInfo({ commit }) {
      Axios.get(`/api/user`)
        .then(({ data }) => {
          commit("setUser", { ...data[0] });
        })
        .catch(() => {
          // localStorage.removeItem("token");
          // router.push("/login");
        });
    },
  },

  getters: {
    status(state) {
      return state.status;
    },

    user(state) {
      return state.userToken;
    },

    error(state) {
      return state.error;
    },
  },
};

export default login;
