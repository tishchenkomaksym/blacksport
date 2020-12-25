import axios from 'axios'

export default {
  namespaced: true,
  state: () => ({
    basket: {},
  }),
  getters: {
    productNumber: (state) => {
      return Object.values(state.basket).reduce((productNumber, count) => productNumber + count, 0)
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
    }
  },
  mutations: {
    setBasket: (state, data) => state.basket = data,
  },
}
