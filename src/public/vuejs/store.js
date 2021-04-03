import Vue from 'vue'
import Vuex from 'vuex'
// import VuexPersistence from 'vuex-persist'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    showSetting: false,
    cssVars: TPDPA.css_var,
  },
  mutations: {
    SHOW_SETTING(state, payload) {
      state.showSetting = payload
      document.documentElement.classList.toggle('thailand-pdpa-show-setting')
    },

    CSS_VARS(state, payload) {
      state.cssVars = payload
    },
  },
  // plugins: [new VuexPersistence().plugin],
})

export default store
