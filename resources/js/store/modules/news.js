import axios from 'axios'

/** @typedef {import('../../types').Article} Article */

export default {
  namespaced: true,
  state: () => ({
    /** @type Article[] */
    news: [],
  }),
  actions: {
    /**
     * @description Get all news
     * @name getNews
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     * @example store.dispatch('pages/getNews', 'en')
     */
    getNews: async ({commit}, locale) => commit('setNews', (await axios.get(`/news/${locale}`))),
    /**
     * @description Get an article
     * @name getArticle
     * @param commit {import('vuex').Commit}
     * @param id {number}
     * @param locale {string}
     * @example store.dispatch('pages/getArticle', {id: 1, locale: 'en'})
     * @return {Promise<import('axios').AxiosResponse<Article>>}
     */
    getArticle: async ({commit}, {id, locale}) => (await axios.get(`/news/${id}/${locale}`))[0],
  },
  mutations: {
    setNews: (state, data) => state.news = data,
  },
}
