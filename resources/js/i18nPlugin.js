import {ref, reactive, provide, inject} from 'vue'

const createI18n = config => ({
  locale: ref(config.locale),
  translations: reactive(config.translations),
  /**
   * @description Method for changing a language.
   * @example setLanguage('en')
   * @param locale {string}
   */
  setLanguage(locale) {
    this.locale.value = locale
  },
  /**
   * @description Method for getting translations inside components. Supports dot notation.
   * @example t('defaults.home')
   * @param key {string}
   * @returns string
   */
  $t(key) {
    return key.split('.').reduce((prev, curr) => prev ? prev[curr] : null, this.translations[this.locale.value])
  },
})

const i18nSymbol = Symbol()

export const provideI18n = i18nConfig => {
  const i18n = createI18n(i18nConfig)
  provide(i18nSymbol, i18n)
}

export const useI18n = () => {
  const i18n = inject(i18nSymbol)
  if (!i18n) throw new Error('No i18n provided!!!')

  return i18n
}
