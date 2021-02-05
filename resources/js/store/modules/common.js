import axios from 'axios'

/** @typedef {import('../../types').Contacts} Contacts */
/**
 * @typedef CommonState
 * @property {string} backgroundColor
 * @property {boolean} menuShown
 * @property {boolean} basketOpen
 * @property {Contacts[]} contacts
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
    contacts: [],
  }),
  getters: {
    socialLinks: state => state.contacts[0] ? state.contacts[0].social_links : [],
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
  },
  mutations: {
    toggleMenu: state => state.menuShown = !state.menuShown,
    setBackgroundColor: (state, backgroundColor = 'bgColor') => state.backgroundColor = COLORS[backgroundColor],
    setContacts: (state, contacts) => state.contacts = contacts,
    setBasketOpen: (state, isOpen) => {
      state.menuShown = false
      state.basketOpen = isOpen
    },
  },
}
