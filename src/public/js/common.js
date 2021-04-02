import Vue from 'vue'
import App from '../vuejs/App.vue'
import store from '../vuejs/store'

export default {
  init() {
    new Vue({
      el: '#thailand-pdpa',
      components: { App },
      store,
    })
  },
  finalize() {},
}
