import axios from 'axios'

/** @typedef {import('../../types').Contacts} Contacts */

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
  actions: {
    getContacts: async ({commit}) => commit('setContacts', await axios.get('/contacts')),
  },
  mutations: {
    toggleMenu: state => state.menuShown = !state.menuShown,
    setBackgroundColor: (state, backgroundColor = 'bgColor') => state.backgroundColor = COLORS[backgroundColor],
    setContacts: (state, contacts) => state.contacts = contacts,
  },
}
