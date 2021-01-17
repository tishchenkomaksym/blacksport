import axios from 'axios'

/** @typedef {import('../../types').Program} Program */

export default {
  namespaced: true,
  state: () => ({
    /** @type Program[] */
    programs: [],
  }),
  actions: {
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
    setPrograms: (state, data) => state.programs = data,
  },
}
