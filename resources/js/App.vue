<template>
  <Layout :background-color="backgroundColor">
    <router-view/>
  </Layout>
</template>

<script>
import {computed, onMounted} from 'vue'
import {useStore} from 'vuex'
import {provideI18n} from './i18nPlugin'
import {LANGS} from './router'
import en from './assets/locale/en.json'
import ru from './assets/locale/ru.json'
import ua from './assets/locale/ua.json'

import Layout from './components/Layout/Layout'

export default {
  name: 'App',
  components: {Layout},
  setup() {
    const {state, dispatch} = useStore()
    const backgroundColor = computed(() => state.common.backgroundColor)

    onMounted(() => {
      dispatch('products/getBasket')
    })

    provideI18n({
      locale: LANGS[0],
      translations: {
        en: {
          defaults: {...en},
        },
        ru: {
          defaults: {...ru},
        },
        ua: {
          defaults: {...ua},
        },
      },
    })

    return {
      backgroundColor,
    }
  },
}
</script>

<style lang="scss">
#app {
  height: 100vh;
  overflow: hidden;
}

main {
  height: 100%;
  overflow-y: auto;
}
</style>
