import {createStore} from 'vuex'
// Modules
import common from './modules/common'

const store = createStore({
  modules: {
    common,
  }
})

export default store
