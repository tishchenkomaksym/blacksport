<template>
  <Layout>
    <router-view/>
  </Layout>
</template>

<script>
import {provideI18n} from './i18nPlugin'
import Layout from './components/Layout/Layout'

export default {
  name: 'App',
  components: {Layout},
  setup() {
    provideI18n({
      locale: 'en',
      messages: {
        en: {
          helloWorld: 'Hello world',
        },
        ru: {
          helloWorld: 'Привет мир',
        },
        ua: {
          helloWorld: 'Привiт свiту',
        },
      },
    })
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
}
</style>
