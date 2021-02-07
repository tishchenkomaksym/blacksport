<template>
  <Layout :background-color="backgroundColor">
    <router-view/>
  </Layout>
</template>

<script>
import {computed, onMounted, watch} from 'vue'
import {useStore} from 'vuex'
import {useRoute, useRouter} from 'vue-router'
import {useI18n} from 'vue-i18n'

import Layout from './components/Layout/Layout'

export default {
  name: 'App',
  components: {Layout},
  setup() {
    const {state, dispatch} = useStore()
    const router = useRouter()
    const route = useRoute()
    const {locale} = useI18n()
    const backgroundColor = computed(() => state.common.backgroundColor)

    onMounted(() => {
      dispatch('products/getBasket')
      dispatch('common/getContacts')
    })

    watch(locale, locale => {
      router.replace({name: route.name, params: {locale}, query: {...route.query}})
    })

    return {
      backgroundColor,
    }
  },
}
</script>
