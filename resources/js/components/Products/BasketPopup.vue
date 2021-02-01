<template>
  <transition appear name="basket-transition">
    <div class="basket">
      <BasketList
        :total-price="totalPrice"
        @on-next-step="onNextStep"
        v-if="step === 0"
      />
      <BasketCheckout
        :products="products"
        :total-price="totalPrice"
        @on-next-step="onNextStep"
        v-else-if="step === 1"
      />
      <BasketCheckoutDone
        v-else-if="step === 2"
      />
    </div>
  </transition>
</template>

<script>
import {computed, ref, watch} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'

import BasketList from './BasketList'
import BasketCheckout from './BasketCheckout'
import BasketCheckoutDone from './BasketCheckoutDone'

export default {
  name: 'BasketPopup',
  components: {BasketCheckoutDone, BasketCheckout, BasketList},
  setup() {
    const {dispatch, state} = useStore()
    const {locale} = useI18n()
    const basket = computed(() => state.products.basket)
    const step = ref(0)
    const totalPrice = ref(0)
    const products = ref([])

    const getBasketProducts = async () => {
      let total = 0
      for (const productId of Object.keys(basket.value)) {
        const product = await dispatch('products/getProduct', {productId, locale: locale.value})
        products.value.push({
          id: product.id,
          name: product.title,
          price: product.price,
          quantity: basket.value[productId],
        })
        total += basket.value[productId] * product.price
      }
      totalPrice.value = total
    }

    const onNextStep = () => step.value += 1

    watch(basket, getBasketProducts, {immediate: true})

    return {
      step,
      onNextStep,
      totalPrice,
      products,
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