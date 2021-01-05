import {createApp} from 'vue'
import axios from 'axios'
import App from './App.vue'
import router from './router'
import store from './store'
import Maska from 'maska'

import 'normalize.css'
import './assets/scss/index.scss'
import '@glidejs/glide/src/assets/sass/glide.core.scss'

axios.defaults.baseURL = '/api'
axios.interceptors.response.use(value => {
  console.log('response', value.data)
  return value.data
})

createApp(App)
  .use(router)
  .use(store)
  .use(Maska)
  .mount('#app')
