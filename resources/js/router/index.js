import {createRouter, createWebHistory} from 'vue-router'
import i18n, {DEFAULT_LANG} from '../i18n'

import Home from '../views/Home.vue'
import News from '../views/News'
import About from '../views/About'
import Services from '../views/Services'
import Products from '../views/Products'
import Programs from '../views/Programs'
import Product from '../views/Product'
import Contacts from '../views/Contacts'
import Article from '../views/Article'
import TermsConditions from '../views/TermsConditions'
import RefundPolicy from '../views/RefundPolicy'

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
  TERMS: {name: 'Terms', path: '/terms'},
  REFUND: {name: 'Refund', path: '/refund-policy'},
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
    component: News,
    meta: {title: 'news'},
  },
  {
    path: `/:locale${ROUTE_CONF.ABOUT.path}`,
    name: ROUTE_CONF.ABOUT.name,
    component: About,
    meta: {title: 'about'},
  },
  {
    path: `/:locale${ROUTE_CONF.SERVICES.path}`,
    name: ROUTE_CONF.SERVICES.name,
    component: Services,
    meta: {title: 'services'},
  },
  {
    path: `/:locale${ROUTE_CONF.PRODUCTS.path}`,
    name: ROUTE_CONF.PRODUCTS.name,
    component: Products,
    meta: {title: 'products'},
  },
  {
    path: `/:locale${ROUTE_CONF.PROGRAMS.path}`,
    name: ROUTE_CONF.PROGRAMS.name,
    component: Programs,
    meta: {title: 'programs'},
  },
  {
    path: `/:locale${ROUTE_CONF.CONTACTS.path}`,
    name: ROUTE_CONF.CONTACTS.name,
    component: Contacts,
    meta: {title: 'contacts'},
  },
  {
    path: `/:locale${ROUTE_CONF.PRODUCT.path}`,
    name: ROUTE_CONF.PRODUCT.name,
    component: Product,
  },
  {
    path: `/:locale${ROUTE_CONF.ARTICLE.path}`,
    name: ROUTE_CONF.ARTICLE.name,
    component: Article,
  },
  {
    path: `/:locale${ROUTE_CONF.TERMS.path}`,
    name: ROUTE_CONF.TERMS.name,
    component: TermsConditions,
    meta: {title: 'termsAndConditions'},
  },
  {
    path: `/:locale${ROUTE_CONF.REFUND.path}`,
    name: ROUTE_CONF.REFUND.name,
    component: RefundPolicy,
    meta: {title: 'refundPolicy'},
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeResolve((to, from, next) => {
  const {title} = to.meta
  if (title) document.title = `Blacksport | ${i18n.global.t(title)}`
  else document.title = 'Blacksport'

  next()
})

router.beforeEach((to, from, next) => {
  const {locale} = to.params
  if (i18n.global.availableLocales.includes(locale)) next()
  else next(DEFAULT_PATH)
})

export default router
