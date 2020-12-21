import {createApp} from 'vue'
import axios from 'axios'
import App from './App.vue'
import router from './router'
import store from './store'

import 'normalize.css'
import './assets/scss/index.scss'

axios.defaults.baseURL = '/api'
axios.interceptors.response.use(value => {
  console.log('response', value.data)
  return value.data
})

createApp(App)
  .use(router)
  .use(store)
  .mount('#app')
