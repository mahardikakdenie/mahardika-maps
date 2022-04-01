import axios from "axios";
export default {
  namespaced: true,
  state: {
    data: [],
    show: {},
  },
  mutations: {
    SET_DATA: (state, payload) => {
      state.data = payload;
    },
    SET_SHOW: (state, payload) => (state.show = payload),
    INSERT_DATA: (state, payload) => {
      const data = state.data;
      data.push(payload);
      state.data = data;
    },
  },
  actions: {
    getData({ commit }, payload) {
      axios.defaults.baseURL = process.env.VUE_APP_API_URL;
      return new Promise((resolve, reject) => {
        const params = { ...payload };
        axios
          .get("map", { params: params })
          .then((res) => {
            resolve(res.data);
            commit("SET_DATA", res.data.data);
          })
          .catch((e) => {
            reject(e);
          });
      });
    },
    showData({ commit }, payload) {
      axios.defaults.baseURL = process.env.VUE_APP_API_URL;
      return new Promise((resolve, reject) => {
        const params = { ...payload };
        axios
          .get("map/first", { params: params })
          .then((res) => {
            resolve(res);
            commit("SET_SHOW", res.data.data);
          })
          .catch((e) => {
            reject(e);
          });
      });
    },
    inserData({ commit }, payload) {
      axios.defaults.baseURL = process.env.VUE_APP_API_URL;
      return new Promise((resolve, reject) => {
        axios
          .post("map", { ...payload })
          .then((res) => {
            resolve(res);
            commit("INSERT_DATA", res.data.data);
          })
          .catch((e) => {
            reject(e);
          });
      });
    },
  },
};
