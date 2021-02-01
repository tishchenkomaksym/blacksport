<template>
  <div class="checkout-done">
    <h1>{{t('orderDone')}}</h1>
    <Button @click="goToHome">
      {{t('toHome')}}
    </Button>
  </div>
</template>

<script>
import {computed} from 'vue'
import {useRouter} from 'vue-router'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'

import Button from '../Base/Button'

export default {
  name: 'BasketCheckoutDone',
  components: {Button},
  setup() {
    const router = useRouter()
    const {commit} = useStore()
    const {locale, t} = useI18n()
    const homePath = computed(() => `/${locale.value}`)

    const goToHome = () => {
      commit('common/setBasketOpen', false)
      router.push(homePath.value)
    }

    return {
      t,
      goToHome,
    }
  },
}
</script>

<style scoped lang="scss">
.checkout-done {
  height: calc(100% - 50px);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
</style>
