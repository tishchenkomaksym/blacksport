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
import {computed, watch} from 'vue'
import {useRoute} from 'vue-router'
import {useI18n} from '../../i18nPlugin'
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
    const i18n = useI18n()
    const route = useRoute()
    const {state} = useStore()

    watch(() => route.params.locale, locale => i18n.setLanguage(locale))

    return {
      menuShown: computed(() => state.common.menuShown),
    }
  }
}
</script>

<style scoped lang="scss">
main {
  transition: filter 0.3s ease-in-out;
  will-change: filter;

  &.blurred {
    filter: blur(16px);
  }
}
</style>
