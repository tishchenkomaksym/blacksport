<template>
  <Header/>
  <main
    :class="{blurred: menuShown}"
    :style="{backgroundColor}"
  >
    <slot/>
  </main>
  <Footer/>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'

import Header from './Header'
import Footer from './Footer'

export default {
  name: 'Layout',
  components: {Header, Footer},
  props: {
    backgroundColor: String,
  },
  setup() {
    const {state} = useStore()

    return {
      menuShown: computed(() => state.common.menuShown),
    }
  }
}
</script>

<style scoped lang="scss">
main {
  transition: filter 0.3s ease-in-out;

  &.blurred {
    filter: blur(16px);
  }
}
</style>
