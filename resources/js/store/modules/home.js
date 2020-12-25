import axios from 'axios'

/** @typedef {import('../../types').NewsItem} NewsItem */
/** @typedef {import('../../types').ServiceExample} ServiceExample */
/** @typedef {import('../../types').ServiceItem} ServiceItem */

export default {
  namespaced: true,
  state: () => ({
    homeData: {
      /** @type NewsItem[] */
      news: [],
      programs: [],
      /** @type ServiceItem[] */
      services: [],
      popular_products: [],
      texts: [],
    },
  }),
  actions: {
    /**
     * @desc Get home page data.
     * @name getHomeData
     * @param commit
     * @param locale {string}
     */
    getHomeData: async ({ commit }, locale) => commit('setHomeData', await axios.get(`/home/${locale}`)),
  },
  mutations: {
    setHomeData: (state, data) => state.homeData = data,
  },
}
