import axios from 'axios'

/** @typedef {import('../types').ServiceItem} ServiceItem */
/** @typedef {import('../types').OrderServiceData} OrderServiceData */

export default {
  /**
   * @description Get list of services.
   * @param {string} locale
   * @return {Promise<ServiceItem[]>}
   */
  getServices: async locale => await axios.get(`/services/${locale}`),
  /**
   * @description Order a service.
   * @param {OrderServiceData} data - Order service data.
   * @return {Promise<any>}
   */
  orderService: async data => await axios.post('/service/request', data),
}
