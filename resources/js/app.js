import {createApp} from 'vue'
import axios from 'axios'
import router from './router'
import store from './store'
import Maska from 'maska'
import i18n from './i18n'
import VueClickAway from 'vue3-click-away'

import App from './App.vue'

import 'normalize.css'
import './assets/scss/index.scss'
import '@glidejs/glide/src/assets/sass/glide.core.scss'

axios.defaults.baseURL = process.env.MIX_API_URL
axios.interceptors.response.use(value => {
  console.log('response', value.data)
  return value.data
})

createApp(App)
  .use(router)
  .use(store)
  .use(Maska)
  .use(i18n)
  .use(VueClickAway)
  .mount('#app')
