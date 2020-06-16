require('./bootstrap');

window.Vue = require('vue');

import ErrMessage from './components/ErrMessage.vue'
import LoadingBar from './components/LoadingBar.vue'

Vue.component('err-message', ErrMessage)
Vue.component('loading-bar', LoadingBar)