import {createStore} from 'vuex'
// Modules
import common from './modules/common'
import home from './modules/home'
import products from './modules/products'
import pages from './modules/pages'

const store = createStore({
  modules: {
    common,
    home,
    products,
    pages,
  }
})

export default store
