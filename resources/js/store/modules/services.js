import axios from 'axios'

/** @typedef {import('../../types').ServiceItem} ServiceItem */

export default {
  namespaced: true,
  state: () => ({
    /** @type ServiceItem[] */
    services: []
  }),
  actions: {
    /**
     * @description Get list of services
     * @name getServices
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     */
    getServices: async ({commit}, locale) => commit('setServices', (await axios.get(`/services/${locale}`)).services),
    orderService: async ({commit}, data) => await axios.post('/service/request', data),
  },
  mutations: {
    setServices: (state, data) => state.services = data,
  },
}
