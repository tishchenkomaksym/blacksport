import {createStore} from 'vuex'
// Modules
import common from './modules/common'
import home from './modules/home'
import products from './modules/products'
import pages from './modules/pages'
import services from './modules/services'
import programs from './modules/programs'
import news from './modules/news'

const store = createStore({
  modules: {
    common,
    home,
    products,
    pages,
    services,
    programs,
    news,
  }
})

export default store
