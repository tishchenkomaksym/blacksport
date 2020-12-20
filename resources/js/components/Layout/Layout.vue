<template>
  <Header/>
  <main :class="{blurred: menuShown}">
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
  setup() {
    const i18n = useI18n()
    const route = useRoute()
    const store = useStore()

    watch(() => route.params.locale, locale => i18n.setLanguage(locale))

    return {
      menuShown: computed(() => store.state.common.menuShown),
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

main {
  transition: all 0.3s ease-in-out;
  will-change: filter, opacity;

  &.blurred {
    filter: blur(16px);
    opacity: 0.7;

    @include tablets() {
      opacity: initial;
    }
  }
}
</style>
