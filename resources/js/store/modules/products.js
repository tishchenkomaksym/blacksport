import axios from 'axios'

export default {
  namespaced: true,
  state: () => ({
    basket: {},
    products: [],
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
     * @desc Get basket
     * @param commit
     * @return {Promise<void>}
     */
    getBasket: async ({commit}) => {
      const basket = await axios.get('/basket')
      commit('setBasket', Array.isArray(basket) ? {} : basket)
    },
    /**
     * @desc Add product to the basket
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
     * @desc Update product in the basket
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
     * @desc Delete product from the basket
     * @param dispatch
     * @param productId {number}
     * @return {Promise<void>}
     */
    deleteFromBasket: async ({dispatch}, {productId}) => {
      await axios.delete(`/basket/${productId}`)
      dispatch('getBasket')
    },
    /**
     * @desc Get all products
     * @param commit
     * @param locale {string}
     */
    getProducts: async ({commit}, locale) => commit('setProducts', (await axios.get(`/products/${locale}`)).products),
    /**
     * @desc Get a specific product
     * @param commit
     * @param id
     * @param locale {string}
     * @return {Promise<import('axios').AxiosResponse<any>>}
     */
    getProduct: async ({commit}, {id, locale}) => await axios.get(`/product/${id}/${locale}`),
    /**
     * @desc Get products by a category ID
     * @param commit
     * @param categoryId {number}
     * @param locale {string}
     * @return {Promise<import('axios').AxiosResponse<any>>}
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
