import axios from 'axios'

/** @typedef {import('../../types').Category} Category */
/** @typedef {import('../../types').ProductItem} ProductItem */

export default {
  namespaced: true,
  state: () => ({
    basket: {},
    /** @type Category[] */
    categories: [],
    /** @type ProductItem[] */
    products: [],
    /** @type ProductItem[] */
    categoryProducts: [],
  }),
  getters: {
    productNumber: ({basket}) => {
      return Object.values(basket).reduce((productNumber, count) => productNumber + count, 0)
    },
  },
  actions: {
    /**
     * @description Get basket
     * @param commit {import('vuex').Commit}
     * @return {Promise<void>}
     */
    getBasket: async ({commit}) => {
      const basket = await axios.get('/basket')
      commit('setBasket', Array.isArray(basket) ? {} : basket)
    },
    /**
     * @description Add product to the basket
     * @param dispatch {import('vuex').Dispatch}
     * @param productId {number}
     * @param count {number}
     * @return {Promise<void>}
     */
    addToBasket: async ({dispatch}, {productId, count = 1}) => {
      await axios.post(`/basket/${productId}/${count}`)
      await dispatch('getBasket')
    },
    /**
     * @description Update product in the basket
     * @param dispatch {import('vuex').Dispatch}
     * @param productId {number}
     * @param count {number}
     * @return {Promise<void>}
     */
    updateBasket: async ({dispatch}, {productId, count}) => {
      await axios.patch(`/basket/${productId}/${count}`)
      await dispatch('getBasket')
    },
    /**
     * @description Delete product from the basket
     * @param dispatch {import('vuex').Dispatch}
     * @param productId {number}
     * @return {Promise<void>}
     */
    deleteFromBasket: async ({dispatch}, {productId}) => {
      await axios.delete(`/basket/${productId}`)
      await dispatch('getBasket')
    },
    /**
     * @description Get all products
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     */
    getProducts: async ({commit}, locale) => commit('setProducts', (await axios.get(`/products/${locale}`))),
    /**
     * @description Get a specific product
     * @param commit
     * @param id {number | string}
     * @param locale {string}
     * @return {Promise<import('axios').AxiosResponse<ProductItem>>}
     */
    getProduct: async ({commit}, {id, locale}) => (await axios.get(`/product/${id}/${locale}`))[0],
    /**
     * @description Get products by a category ID
     * @param commit {import('vuex').Commit}
     * @param categoryId {number}
     * @param locale {string}
     * @example store.dispatch('products/getProductCategory', {id: 1, locale: 'en'})
     */
    getProductCategory: async ({commit}, {categoryId, locale}) =>
      commit('setCategoryProducts', (await axios.get(`/product_category/${categoryId}/${locale}`))),
    /**
     * @description Get product categories
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     */
    getCategories: async ({commit}, locale) => commit('setCategories', await axios.get(`/categories/${locale}`)),
  },
  mutations: {
    setBasket: (state, data) => state.basket = data,
    setProducts: (state, data) => state.products = data,
    setCategoryProducts: (state, data) => state.categoryProducts = data,
    setCategories: (state, data) => state.categories = data,
  },
}
