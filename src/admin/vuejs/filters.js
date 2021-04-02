import Vue from 'vue'

Vue.filter('formatMoney', (val) => {
  return numeral(val).format('0,0')
})
