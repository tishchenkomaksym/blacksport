import {createRouter, createWebHistory} from 'vue-router'
import Home from '../views/Home.vue'

export const ROUTE_CONF = {
  HOME: {name: 'Home', path: '/'},
  NEWS: {name: 'News', path: '/news'},
  ABOUT: {name: 'About', path: '/about'},
  SERVICES: {name: 'Services', path: '/services'},
  PRODUCTS: {name: 'Products', path: '/products'},
  PROGRAMS: {name: 'Programs', path: '/programs'},
  CONTACTS: {name: 'Contacts', path: '/contacts'},
}

export const LANGS = [
  'ua',
  'en',
  'ru',
]

export const DEFAULT_PATH = `/${LANGS[0]}${ROUTE_CONF.HOME.path}`

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
  },
  {
    path: `/:locale${ROUTE_CONF.ABOUT.path}`,
    name: ROUTE_CONF.ABOUT.name,
    component: () => import('../views/About.vue'),
  },
  {
    path: `/:locale${ROUTE_CONF.SERVICES.path}`,
    name: ROUTE_CONF.SERVICES.name,
    component: () => import('../views/Services.vue'),
  },
  {
    path: `/:locale${ROUTE_CONF.PRODUCTS.path}`,
    name: ROUTE_CONF.PRODUCTS.name,
    component: () => import('../views/Products.vue'),
  },
  {
    path: `/:locale${ROUTE_CONF.PROGRAMS.path}`,
    name: ROUTE_CONF.PROGRAMS.name,
    component: () => import('../views/Programs.vue'),
  },
  {
    path: `/:locale${ROUTE_CONF.CONTACTS.path}`,
    name: ROUTE_CONF.CONTACTS.name,
    component: () => import('../views/Contacts.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const {locale} = to.params
  if (LANGS.includes(locale)) next()
  else next(DEFAULT_PATH)
})

export default router
