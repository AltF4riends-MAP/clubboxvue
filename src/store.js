// src/store.js
import { createStore } from 'vuex';

const store = createStore({
  state: {
    userId: null
  },
  mutations: {
    setUserId(state, userId) {
      state.userId = userId;
    }
  },
  actions: {
    saveUserId({ commit }, userId) {
      commit('setUserId', userId);
    }
  },
  getters: {
    userId: state => state.userId
  }
});

export default store;
