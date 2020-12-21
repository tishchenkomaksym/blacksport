import {createStore} from 'vuex'
// Modules
import common from './modules/common'
import home from './modules/home'

const store = createStore({
  modules: {
    common,
    home,
  }
})

export default store
