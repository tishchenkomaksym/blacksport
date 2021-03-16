import servicesApi from '../../api/services'

/** @typedef {import('../../types').ServiceItem} ServiceItem */
/** @typedef {import('../../types').OrderServiceData} OrderServiceData */
/** @typedef {import('vuex').Commit} Commit */
/**
 * @typedef ServiceState
 * @property services {ServiceItem[]}
 */

/** @type import('vuex').Module<ServiceState, any> */
const services = {
  namespaced: true,
  state: () => ({
    services: [],
  }),
  actions: {
    /**
     * @description Get list of services.
     * @param {Commit} commit
     * @param {string} locale
     */
    getServices: async ({commit}, locale) =>
      commit('setServices', await servicesApi.getServices(locale)),
    /**
     * @description Order a service.
     * @param {Commit} commit
     * @param {OrderServiceData} data - Order service data.
     * @return {Promise<any>}
     */
    orderService: async ({commit}, data) => await servicesApi.orderService(data),
  },
  mutations: {
    setServices: (state, data) => state.services = data,
  },
}

export default services
