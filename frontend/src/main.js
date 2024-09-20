import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@/assets/css/main.css'
import FlagIcon from 'vue-flag-icon'
Vue.use(FlagIcon);

import ClickOutside from 'vue-click-outside'
Vue.directive('click-outside', ClickOutside)

import Vue2SmoothScroll from 'vue2-smooth-scroll';
Vue.use(Vue2SmoothScroll, {duration: 800, updateHistory: false})

Vue.config.productionTip = false

export const bus = new Vue({})


import i18n from './i18/index'
new Vue({
  router,
  store,
  render: h => h(App),
  i18n
}).$mount('#app')
