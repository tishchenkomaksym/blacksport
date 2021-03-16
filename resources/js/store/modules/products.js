import basket from '../../api/basket'
import products from '../../api/products'

/** @typedef {import('axios').AxiosResponse} AxiosResponse */
/** @typedef {import('../../types').Category} Category */
/** @typedef {import('../../types').ProductItem} ProductItem */
/** @typedef {import('vuex').Dispatch} Dispatch */
/** @typedef {import('vuex').Commit} Commit */
/**
 * @typedef ProductsState
 * @property {Record<string, number>} basket
 * @property {Category[]} categories
 * @property {ProductItem[]} products
 * @property {ProductItem[]} categoryProducts
 */

export default {
  namespaced: true,
  /** @return ProductsState */
  state: () => ({
    basket: {},
    categories: [],
    products: [],
    categoryProducts: [],
  }),
  getters: {
    productNumber: ({basket}) => {
      return Object.values(basket).reduce((productNumber, count) => productNumber + count, 0)
    },
  },
  actions: {
    /**
     * @description Get basket.
     * @param {Commit} commit
     * @return {Promise<void>}
     */
    getBasket: async ({commit}) =>
      commit('setBasket', await basket.getBasket()),
    /**
     * @description Add product item(-s) to basket.
     * @param {Commit} commit
     * @param {number} productId - Product ID.
     * @param {number} [count=1] - Number of products to be added.
     * @return {Promise<void>}
     */
    addToBasket: async ({commit}, {productId, count = 1}) =>
      commit('setBasket', await basket.addToBasket(productId, count)),
    /**
     * @description Update product in the basket
     * @param {Commit} commit
     * @param {number} productId - Product ID.
     * @param {number} count - Number of products to be added.
     * @return {Promise<void>}
     */
    updateBasket: async ({commit}, {productId, count}) =>
      commit('setBasket', await basket.updateBasket(productId, count)),
    /**
     * @description Delete a product from the basket.
     * @param {Commit} commit
     * @param {number} productId - Product ID.
     * @return {Promise<void>}
     */
    deleteFromBasket: async ({commit}, productId) =>
      commit('setBasket', await basket.deleteFromBasket(productId)),
    /**
     * @description Delete all products from basket.
     * @param {Dispatch} dispatch
     * @param {number[]} productIds - List of product IDs.
     * @return {Promise<void>}
     */
    deleteBasket: async ({dispatch}, productIds) => {
      for (const productId of productIds) await basket.deleteFromBasket(productId)
      await dispatch('getBasket')
    },
    /**
     * @description Get all products in a specific locale.
     * @param {Commit} commit
     * @param {string} locale
     */
    getProducts: async ({commit}, locale) =>
      commit('setProducts', await products.getProducts(locale)),
    /**
     * @description Get a specific product by ID.
     * @param {Commit} commit
     * @param {number | string} productId - Product ID.
     * @param {string} locale
     * @return {Promise<AxiosResponse<ProductItem | undefined>>}
     */
    getProduct: async ({commit}, {productId, locale}) =>
      await products.getProduct(productId, locale),
    /**
     * @description Get products by a category ID.
     * @param {Commit} commit
     * @param {number} categoryId
     * @param {string} locale
     */
    getProductCategory: async ({commit}, {categoryId, locale}) =>
      commit('setCategoryProducts', await products.getProductCategory(categoryId, locale)),
    /**
     * @description Get product categories.
     * @param {Commit} commit
     * @param {string} locale
     * @return Promise<void>
     */
    getCategories: async ({commit}, locale) =>
      commit('setCategories', await products.getCategories(locale)),
  },
  mutations: {
    setBasket: (state, data) => state.basket = data,
    setProducts: (state, data) => state.products = data,
    setCategoryProducts: (state, data) => state.categoryProducts = data,
    setCategories: (state, data) => state.categories = data,
  },
}
