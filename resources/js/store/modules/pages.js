import axios from 'axios'

/** @typedef {import('../../types').About} About */
/** @typedef {import('../../types').Article} Article */
/** @typedef {import('../../types').Program} Program */

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
    /** @type Program[] */
    programs: [],
  }),
  actions: {
    /**
     * @description Get about us page data
     * @name getAbout
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     * @example store.dispatch('pages/getAbout', 'en')
     */
    getAbout: async ({commit}, locale) => commit('setAbout', await axios.get(`/about/${locale}`)),
    /**
     * @description Get all news
     * @name getNews
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     * @example store.dispatch('pages/getNews', 'en')
     */
    getNews: async ({commit}, locale) => commit('setNews', (await axios.get(`/news/${locale}`)).news),
    /**
     * @description Get an article
     * @name getArticle
     * @param commit {import('vuex').Commit}
     * @param id {number}
     * @param locale {string}
     * @example store.dispatch('pages/getArticle', {id: 1, locale: 'en'})
     * @return {Promise<import('axios').AxiosResponse<Article>>}
     */
    getArticle: async ({commit}, {id, locale}) => (await axios.get(`/news/${id}/${locale}`)).news[0],
    /**
     * @description Get all programs
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     */
    getPrograms: async ({commit}, locale) => commit('setPrograms', (await axios.get(`/programs/${locale}`)).programs),
    /**
     * @description Submit a program application
     * @param commit {import('vuex').Commit}
     * @param data {object}
     * @return {Promise<import('axios').AxiosResponse<any>>}
     */
    submitApplication: async ({commit}, data) => await axios.post('/program/request', data),
  },
  mutations: {
    setAbout: (state, data) => state.about = data,
    setNews: (state, data) => state.news = data,
    setPrograms: (state, data) => state.programs = data,
  },
}
