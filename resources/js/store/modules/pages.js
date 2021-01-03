import axios from 'axios'

/** @typedef {import('../../types').About} About */
/** @typedef {import('../../types').Article} Article */

export default {
  namespaced: true,
  state: () => ({
    /** @type About */
    about: {
      achievements: [],
      ambassadors: [],
      partners: [],
      texts: [],
    },
    /** @type Article[] */
    news: [],
  }),
  actions: {
    /**
     * @description Get about us page data
     * @name getAbout
     * @param commit
     * @param locale {string}
     */
    getAbout: async ({commit}, locale) => commit('setAbout', await axios.get(`/about/${locale}`)),
    /**
     * @description Get all news
     * @name getNews
     * @param commit
     * @param locale {string}
     * @example store.dispatch('pages/getNews', 'en')
     */
    getNews: async ({commit}, locale) => commit('setNews', (await axios.get(`/news/${locale}`)).news),
    /**
     * @description Get an article
     * @name getArticle
     * @param commit
     * @param id {number}
     * @param locale {string}
     * @example store.dispatch('pages/getArticle', {id: 1, locale: 'en'})
     * @return {Promise<import('axios').AxiosResponse<Article>>}
     */
    getArticle: async ({commit}, {id, locale}) => (await axios.get(`/news/${id}/${locale}`)).news[0],
  },
  mutations: {
    setAbout: (state, data) => state.about = data,
    setNews: (state, data) => state.news = data,
  },
}
