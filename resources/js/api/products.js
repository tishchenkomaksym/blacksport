import axios from 'axios'

/** @typedef {import('axios').AxiosResponse} AxiosResponse */
/** @typedef {import('../types').ProductItem} ProductItem */
/** @typedef {import('../types').Category} Category */

export default {
  /**
   * @description Get all products in a specific locale.
   * @param {string} locale
   * @return {Promise<AxiosResponse<ProductItem[]>>}
   */
  getProducts: async (locale) => await axios.get(`/products/${locale}`),
  /**
   * @description Get a specific product by ID.
   * @param {number | string} id - Product ID.
   * @param {string} locale
   * @return {Promise<AxiosResponse<ProductItem | undefined>>}
   */
  getProduct: async (id, locale) => (await axios.get(`/product/${id}/${locale}`))[0],
  /**
   * @description Get products by a category ID.
   * @param {number} categoryId - Category ID.
   * @param {string} locale
   * @return {Promise<AxiosResponse<ProductItem[]>>}
   */
  getProductCategory: async (categoryId, locale) => await axios.get(`/product_category/${categoryId}/${locale}`),
  /**
   * @description Get product categories.
   * @param {string} locale
   * @return {Promise<AxiosResponse<Category[]>>}
   */
  getCategories: async (locale) => await axios.get(`/categories/${locale}`),
}
