import {createI18n} from 'vue-i18n'
import uk from './assets/locale/uk.json'
import ru from './assets/locale/ru.json'
import en from './assets/locale/en.json'

export const LANGS = [
  'uk',
  'en',
  'ru',
]

export const DEFAULT_LANG = LANGS[0]

const locale = window.location.pathname.replace(/^\/([^\/]+).*/i,'$1')

const i18n = createI18n({
  legacy: false,
  locale: locale.trim().length && locale !== '/' && LANGS.includes(locale) ? locale : DEFAULT_LANG,
  fallbackLocale: DEFAULT_LANG,
  messages: {
    uk,
    ru,
    en,
  },
})

export default i18n
