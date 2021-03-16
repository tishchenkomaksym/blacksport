import axios from 'axios'

export default {
  /**
   * @description Get text for Terms and Conditions page.
   * @param {string} locale
   * @return {Promise<any>}
   */
  getTerms: async locale => (await axios.get(`/terms_conditions/${locale}`))[0],
  /**
   * @description Get text for Refund policy page.
   * @param {string} locale
   * @return {Promise<any>}
   */
  getRefundPolicy: async locale => (await axios.get(`/refund_policy/${locale}`))[0],
}
