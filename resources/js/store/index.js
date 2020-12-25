import {createStore} from 'vuex'
// Modules
import common from './modules/common'
import home from './modules/home'
import products from './modules/products'

const store = createStore({
  modules: {
    common,
    home,
    products,
  }
})

export default store
