import axios from 'axios'

/** @typedef {import('../../types').ServiceItem} ServiceItem */
/** @typedef {import('../../types').OrderServiceData} OrderServiceData */
/**
 * @typedef ServiceState
 * @property services {ServiceItem[]}
 * @property examplesShown {number}
 */

/** @type import('vuex').Module<ServiceState, any> */
const services = {
  namespaced: true,
  state: () => ({
    services: [],
    examplesShown: null,
  }),
  actions: {
    /**
     * @description Get list of services
     * @name getServices
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     */
    getServices: async ({commit}, locale) => commit('setServices', await axios.get(`/services/${locale}`)),
    /**
     * @param commit {import('vuex').Commit}
     * @param data {OrderServiceData}
     * @return {Promise<import('axios').AxiosResponse<any>>}
     */
    orderService: async ({commit}, data) => await axios.post('/service/request', data),
  },
  mutations: {
    setServices: (state, data) => state.services = data,
    setExamplesShown: (state, serviceId) => state.examplesShown = serviceId,
  },
}

export default services
