<template>
  <Header/>
  <main>
    <slot/>
  </main>
  <Footer/>
</template>

<script>
import {watch} from 'vue'
import {useRoute} from 'vue-router'
import {useI18n} from '../../i18nPlugin'

import Header from './Header'
import Footer from './Footer'

export default {
  name: 'Layout',
  components: {Header, Footer},
  setup() {
    const i18n = useI18n()
    const route = useRoute()

    watch(() => route.params.locale, locale => i18n.setLanguage(locale))
  }
}
</script>

<style scoped lang="scss">
</style>
