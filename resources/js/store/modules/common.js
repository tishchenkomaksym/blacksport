export default {
  namespaced: true,
  state: () => ({
    menuShown: false,
  }),
  mutations: {
    toggleMenu: (state) => state.menuShown = !state.menuShown,
  },
}
