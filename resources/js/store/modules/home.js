import axios from 'axios'

export default {
  namespaced: true,
  state: () => ({
    homeData: {
      news: [],
      programs: [],
      services: [],
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
