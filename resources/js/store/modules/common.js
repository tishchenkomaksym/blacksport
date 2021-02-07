import axios from 'axios'

/** @typedef {import('../../types').Contacts} Contacts */
/**
 * @typedef CommonState
 * @property {string} backgroundColor
 * @property {boolean} menuShown
 * @property {boolean} basketOpen
 * @property {Contacts[]} contacts
 * @property {any} shownServiceExample
 * @property {any} shownServiceOrder
 */

const GOOGLE_MAPS_API_KEY = process.env.MIX_GOOGLE_MAPS_API_KEY

export const COLORS = {
  bgColor: '#000000',
  sole: '#0D0D0D',
  silt: '#1A1A1A',
  smoke: '#262626',
  park: '#6F7478',
}

export default {
  namespaced: true,
  /**
   * @return {CommonState}
   */
  state: () => ({
    backgroundColor: COLORS.bgColor,
    menuShown: false,
    basketOpen: false,
    shownServiceExample: null,
    shownServiceOrder: null,
    contacts: [],
  }),
  getters: {
    socialLinks: ({contacts}) => contacts[0]?.social_links || [],
    isBlurred: ({menuShown, basketOpen, shownServiceExample, shownServiceOrder}) => {
      return menuShown || basketOpen || shownServiceExample || shownServiceOrder
    },
  },
  actions: {
    /**
     * @param commit {import('vuex').Commit}
     * @param locale {string}
     */
    getContacts: async ({commit}, locale) =>
      commit('setContacts', await axios.get(`/contacts/${locale}`)),
    convertAddressToCoords: async (store, address = '') =>
      await axios.get(`https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=${GOOGLE_MAPS_API_KEY}`),
    closeEverything: ({commit}) => {
      commit('setMenuShown', false)
      commit('setBasketOpen', false)
      commit('setShownServiceExample', null)
      commit('setShownServiceOrder', null)
    },
  },
  mutations: {
    setBackgroundColor: (state, backgroundColor = 'bgColor') => state.backgroundColor = COLORS[backgroundColor],
    setContacts: (state, contacts) => state.contacts = contacts,
    setMenuShown: (state, menuShown) => {
      state.basketOpen = false
      state.menuShown = menuShown
    },
    setBasketOpen: (state, isOpen) => {
      state.menuShown = false
      state.basketOpen = isOpen
    },
    setShownServiceExample: (state, shownServiceExample) => state.shownServiceExample = shownServiceExample,
    setShownServiceOrder: (state, shownServiceOrder) => state.shownServiceOrder = shownServiceOrder,
  },
}
