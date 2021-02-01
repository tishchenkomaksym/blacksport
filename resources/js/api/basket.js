import axios from 'axios'

/** @typedef {import('axios').AxiosResponse} AxiosResponse */
/** @typedef {Record<string, number>} Basket */

export default {
  /**
   * @description Get basket items.
   * @return {Promise<AxiosResponse<Basket>>}
   */
  getBasket: async () => {
    const basket = await axios.get('/basket')
    return Array.isArray(basket) ? {} : basket
  },
  /**
   * @description Add product item(-s) to basket.
   * @param {number} productId - Product ID.
   * @param {number} [count=1] - Number of products to be added.
   * @return {Promise<AxiosResponse<Basket>>}
   */
  addToBasket: async (productId, count = 1) => await axios.post(`/basket/${productId}/${count}`),
  /**
   * @description Update existing items in the basket.
   * @param {number} productId - Product ID.
   * @param {number} count - Number of products to be added.
   * @return {Promise<AxiosResponse<Basket>>}
   */
  updateBasket: async (productId, count) => await axios.patch(`/basket/${productId}/${count}`),
  /**
   * @description Delete a product from the basket.
   * @param {number} productId - Product ID.
   * @return {Promise<AxiosResponse<Basket>>}
   */
  deleteFromBasket: async (productId) => await axios.delete(`/basket/${productId}`),
  /**
   * @description Proceed payment.
   * @param {any[]} products
   * @param {any} client
   * @return {Promise<any>}
   */
  proceedPayment: async (products, client) =>
    await axios.post('/payment', {products, client: [client]}),
}
