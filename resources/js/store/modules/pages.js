import axios from 'axios'

/** @typedef {import('../../types').About} About */

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
  },
  mutations: {
    setAbout: (state, data) => state.about = data,
  },
}
