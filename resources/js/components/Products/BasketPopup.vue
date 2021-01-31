<template>
  <transition appear name="basket-transition">
    <div class="basket">
      <BasketList
        :total-price="totalPrice"
        @on-proceed-checkout="isCheckout = true"
        v-if="!isCheckout"
      />
    </div>
  </transition>
</template>

<script>
import {computed, ref, watch} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'

import BasketList from './BasketList'

export default {
  name: 'BasketPopup',
  components: {BasketList},
  setup() {
    const {dispatch, state} = useStore()
    const {locale} = useI18n()
    const basket = computed(() => state.products.basket)
    const isCheckout = ref(false)
    const totalPrice = ref(0)

    const getBasketProducts = async () => {
      let total = 0
      for (const productId of Object.keys(basket.value)) {
        total += basket.value[productId] * (await dispatch('products/getProduct', {productId, locale: locale.value})).price
      }
      totalPrice.value = total
    }

    watch(basket, getBasketProducts, {immediate: true})

    return {
      isCheckout,
      totalPrice,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.basket {
  width: 100vw;
  height: calc(100vh - 50px);
  top: 50px;
  position: absolute;
  z-index: 1;

  @include tablets() {
    top: 78px;
    max-width: 1440px;
    margin: 0 auto;
    padding: $spacing $spacing-lg 0;
    left: 0;
    right: 0;
    height: calc(100vh - 200px);
    box-sizing: border-box;
  }
}

.basket-transition {
  &-enter-active,
  &-leave-active {
    transition: opacity 0.3s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
  }
}
</style>