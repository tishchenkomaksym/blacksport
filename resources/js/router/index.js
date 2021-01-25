import {createRouter, createWebHistory} from 'vue-router'
import i18n, {DEFAULT_LANG} from '../i18n'
import Home from '../views/Home.vue'

export const ROUTE_CONF = {
  HOME: {name: 'Home', path: '/'},
  NEWS: {name: 'News', path: '/news'},
  ABOUT: {name: 'About', path: '/about'},
  SERVICES: {name: 'Services', path: '/services'},
  PRODUCTS: {name: 'Products', path: '/products'},
  PROGRAMS: {name: 'Programs', path: '/programs'},
  CONTACTS: {name: 'Contacts', path: '/contacts'},
  PRODUCT: {name: 'Product', path: '/products/:id'},
  ARTICLE: {name: 'Article', path: '/news/:id'},
}

const DEFAULT_PATH = `/${DEFAULT_LANG}${ROUTE_CONF.HOME.path}`

const routes = [
  {
    path: '/',
    redirect: DEFAULT_PATH,
  },
  {
    path: `/:locale${ROUTE_CONF.HOME.path}`,
    name: ROUTE_CONF.HOME.name,
    component: Home,
  },
  {
    path: `/:locale${ROUTE_CONF.NEWS.path}`,
    name: ROUTE_CONF.NEWS.name,
    // Lazy loading
    component: () => import('../views/News.vue'),
    meta: {title: 'news'},
  },
  {
    path: `/:locale${ROUTE_CONF.ABOUT.path}`,
    name: ROUTE_CONF.ABOUT.name,
    component: () => import('../views/About.vue'),
    meta: {title: 'about'},
  },
  {
    path: `/:locale${ROUTE_CONF.SERVICES.path}`,
    name: ROUTE_CONF.SERVICES.name,
    component: () => import('../views/Services.vue'),
    meta: {title: 'services'},
  },
  {
    path: `/:locale${ROUTE_CONF.PRODUCTS.path}`,
    name: ROUTE_CONF.PRODUCTS.name,
    component: () => import('../views/Products.vue'),
    meta: {title: 'products'},
  },
  {
    path: `/:locale${ROUTE_CONF.PROGRAMS.path}`,
    name: ROUTE_CONF.PROGRAMS.name,
    component: () => import('../views/Programs.vue'),
    meta: {title: 'programs'},
  },
  {
    path: `/:locale${ROUTE_CONF.CONTACTS.path}`,
    name: ROUTE_CONF.CONTACTS.name,
    component: () => import('../views/Contacts.vue'),
    meta: {title: 'contacts'},
  },
  {
    path: `/:locale${ROUTE_CONF.PRODUCT.path}`,
    name: ROUTE_CONF.PRODUCT.name,
    component: () => import('../views/Product.vue')
  },
  {
    path: `/:locale${ROUTE_CONF.ARTICLE.path}`,
    name: ROUTE_CONF.ARTICLE.name,
    component: () => import('../views/Article.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const {locale} = to.params
  if (i18n.global.availableLocales.includes(locale)) next()
  else next(DEFAULT_PATH)
})

export default router
