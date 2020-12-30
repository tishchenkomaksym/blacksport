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
     * @desc Get about us page data
     * @name getAbout
     * @param commit
     * @param locale {string}
     */
    getAbout: async ({commit}, locale) => commit('setAbout', await axios.get(`/about/${locale}`)),
  },
  mutations: {
    setAbout: (state, data) => state.about = data,
  },
}
