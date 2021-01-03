import axios from 'axios'

/** @typedef {import('../../types').ProductItem} ProductItem */

export default {
  namespaced: true,
  state: () => ({
    basket: {},
    /** @type ProductItem[] */
    products: [],
    /** @type ProductItem[] */
    categoryProducts: [],
  }),
  getters: {
    productNumber: ({basket}) => {
      return Object.values(basket).reduce((productNumber, count) => productNumber + count, 0)
    },
    productCategories: ({products}) => {
      const categoriesMap = new Map()
      for (const {categories} of products) {
        if (!categoriesMap.has(categories.id)) {
          categoriesMap.set(categories.id, {id: categories.id, name: categories.name})
        }
      }
      return [...categoriesMap.values()]
    },
  },
  actions: {
    /**
     * @description Get basket
     * @param commit
     * @return {Promise<void>}
     */
    getBasket: async ({commit}) => {
      const basket = await axios.get('/basket')
      commit('setBasket', Array.isArray(basket) ? {} : basket)
    },
    /**
     * @description Add product to the basket
     * @param dispatch
     * @param productId {number}
     * @param count {number}
     * @return {Promise<void>}
     */
    addToBasket: async ({dispatch}, {productId, count = 1}) => {
      await axios.post(`/basket/${productId}/${count}`)
      dispatch('getBasket')
    },
    /**
     * @description Update product in the basket
     * @param dispatch
     * @param productId {number}
     * @param count {number}
     * @return {Promise<void>}
     */
    updateBasket: async ({dispatch}, {productId, count}) => {
      await axios.patch(`/basket/${productId}/${count}`)
      dispatch('getBasket')
    },
    /**
     * @description Delete product from the basket
     * @param dispatch
     * @param productId {number}
     * @return {Promise<void>}
     */
    deleteFromBasket: async ({dispatch}, {productId}) => {
      await axios.delete(`/basket/${productId}`)
      dispatch('getBasket')
    },
    /**
     * @description Get all products
     * @param commit
     * @param locale {string}
     */
    getProducts: async ({commit}, locale) => commit('setProducts', (await axios.get(`/products/${locale}`)).products),
    /**
     * @description Get a specific product
     * @param commit
     * @param id {number | string}
     * @param locale {string}
     * @return {Promise<import('axios').AxiosResponse<ProductItem>>}
     */
    getProduct: async ({commit}, {id, locale}) => (await axios.get(`/product/${id}/${locale}`)).products[0],
    /**
     * @description Get products by a category ID
     * @param commit
     * @param categoryId {number}
     * @param locale {string}
     * @example store.dispatch('products/getProductCategory', {id: 1, locale: 'en'})
     */
    getProductCategory: async ({commit}, {categoryId, locale}) =>
      commit('setCategoryProducts', (await axios.get(`/product_category/${categoryId}/${locale}`)).products),
  },
  mutations: {
    setBasket: (state, data) => state.basket = data,
    setProducts: (state, data) => state.products = data,
    setCategoryProducts: (state, data) => state.categoryProducts = data,
  },
}
