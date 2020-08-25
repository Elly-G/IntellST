import { Axios } from "../api/axios.js";
import router from "../router";

const login = {
  namespaced: true,
  state: () => ({
    userToken: localStorage.getItem("token"),
    allData: null,
    status: null,
    error: null,
    userData: null,
    graphData: null,
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
    setGraph(state, payload) {
      state.graphData = payload;
    },

    removeUser(state) {
      state.userData = null;
    },
  },
  actions: {
    signInAction({ commit, dispatch }, payload) {
      Axios()
        .post("login_check", {
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
      Axios()
        .get("/api/user")
        .then(({ data }) => {
          commit("setUser", { ...data });
        })
        .catch(() => {
          localStorage.removeItem("token");
          router.push("/login");
        });
    },
    setSettings(
      { commit, state, dispatch },
      { temperature, restrictionPeriod }
    ) {
      Axios()
        .post(`/api/enterprises/${state.userData.enterprise}`, {
          temperature,
          restrictionPeriod,
        })
        .then(() => {
          commit("setStatus", "success");

          dispatch(
            "snackbar/showSnack",
            {
              message: "Enterprise successfully edited!",
              type: "success",
            },
            { root: true }
          );
        })

        .catch((e) => {
          commit("setError", e);
        });
    },
    async graphEntries({ commit }) {
      await Axios()
        .get("/api/get-number-of-entries-per-day")
        .then(({ data }) => {
          commit("setGraph", { ...data });
        });
    },
    async graphValid({ commit }) {
      await Axios()
        .get("/api/get-number-of-valid-entries-per-day")
        .then(({ data }) => {
          commit("setGraph", { ...data });
        });
    },
    async graphBanned({ commit }) {
      await Axios()
        .get("/api/get-number-of-returns-of-banned-people")
        .then(({ data }) => {
          commit("setGraph", { ...data });
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
