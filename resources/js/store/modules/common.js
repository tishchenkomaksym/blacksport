import axios from 'axios'

/** @typedef {import('../../types').Contacts} Contacts */

const GOOGLE_MAPS_API_KEY = process.env.MIX_GOOGLE_MAPS_API_KEY

const COLORS = {
  bgColor: '#000',
  sole: '#0D0D0D',
  silt: '#1A1A1A',
  smoke: '#262626',
  park: '#6F7478',
}

export default {
  namespaced: true,
  state: () => ({
    backgroundColor: COLORS.bgColor,
    menuShown: false,
    /** @type Contacts[] */
    contacts: [],
  }),
  getters: {
    socialLinks: state => state.contacts[0] ? state.contacts[0].social_links : [],
  },
  actions: {
    getContacts: async ({commit}) => commit('setContacts', await axios.get('/contacts')),
    convertAddressToCoords: async (store, address = '') =>
      await axios.get(`https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=${GOOGLE_MAPS_API_KEY}`),
  },
  mutations: {
    toggleMenu: state => state.menuShown = !state.menuShown,
    setBackgroundColor: (state, backgroundColor = 'bgColor') => state.backgroundColor = COLORS[backgroundColor],
    setContacts: (state, contacts) => state.contacts = contacts,
  },
}
