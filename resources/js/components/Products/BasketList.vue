<template>
  <div class="basket-list">
    <div class="basket-list__header">
      <h3>{{t('productList')}}</h3>
      <h3>{{t('quantity')}}</h3>
      <h3>{{t('price')}}</h3>
    </div>
    <div class="basket-list__body">
      <template v-if="productNumber > 0">
        <div
          :class="{'basket-list__body-main--padded': isPadded}"
          class="basket-list__body-main"
          ref="productList"
        >
          <BasketProduct
            :key="productId"
            :product-id="productId"
            v-for="productId in productIds"
          />
        </div>
      </template>
      <p v-else>{{t('emptyBasket')}}</p>
    </div>
    <div class="basket-list__total">
      <Button
        :key="width"
        :color="width < 768 ? '#0d0d0d' : null"
        :small="width < 768"
        @click="proceedCheckout"
      >
        {{t('checkout')}}
      </Button>
      <div class="basket-list__total-price">
        <div>{{t('toPay')}}:</div>
        <div>{{n(totalPrice, 'price', localeType)}} <span>₴</span></div>
      </div>
    </div>
  </div>
</template>

<script>
import {computed, onBeforeUnmount, onMounted, ref} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import useWindowSize from '../../hooks/useWindowSize'

import Button from '../Base/Button'
import BasketProduct from './BasketProduct'

export default {
  name: 'BasketList',
  components: {BasketProduct, Button},
  props: {
    totalPrice: {
      type: Number,
      default: 0,
    },
  },
  emits: [
    'on-next-step',
  ],
  setup(props, {emit}) {
    const {t, locale, n} = useI18n()
    const {getters, state} = useStore()
    const localeType = computed(() => locale.value === 'ru' ? 'ru-RU' : locale.value === 'en' ? 'en-US' : 'uk-UA')
    const basket = computed(() => state.products.basket)
    const productIds = computed(() => Object.keys(basket.value))
    const productNumber = computed(() => getters['products/productNumber'])
    const {width} = useWindowSize()
    const productList = ref(null)
    const resizeObserver = ref(null)
    const isPadded = ref(false)

    const proceedCheckout = () => emit('on-next-step')

    const checkPaddings = () => {
      isPadded.value = productList.value.offsetHeight < productList.value.scrollHeight
    }

    onMounted(() => {
      resizeObserver.value = new ResizeObserver(checkPaddings)
      resizeObserver.value.observe(productList.value)
    })

    onBeforeUnmount(() => {
      resizeObserver.value.disconnect()
    })

    return {
      t,
      n,
      localeType,
      width,
      productIds,
      productNumber,
      proceedCheckout,
      isPadded,
      productList,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";
@import "../../assets/scss/page-helpers";

.basket-list {
  height: calc(100% - 80px);
  display: grid;
  grid-template-rows: auto 1fr;
  overflow-y: auto;
  position: relative;

  @include tablets() {
    height: 100%;
    overflow-y: initial;

    &::before, &::after {
      width: 100vw;
      height: 50vh;
      left: #{-$spacing-lg};
      display: block;
      content: "";
      position: absolute;
      background-color: $bg-color;
      pointer-events: none;
      z-index: -1;

      @include large-desktop() {
        width: 150vw;
        left: -50vw;
      }
    }

    &::before {
      top: 0;
      transform: translateY(calc(-100% + 44px));
    }

    &::after {
      bottom: 0;
      transform: translateY(calc(100% - 53px));
    }
  }

  &__header {
    padding: 0 $spacing;
    color: $park;

    @include tablets() {
      padding: initial;
      display: grid;
      grid-template-columns: 1fr 155px 160px 48px;
      column-gap: $spacing-md;
    }

    > h3:not(:first-child) {
      display: none;
    }

    @include tablets() {
      > h3:not(:first-child) {
        display: initial;
      }

      h3:nth-of-type(2), h3:nth-of-type(3) {
        text-align: center;
      }
    }
  }

  &__body {
    padding: $spacing-sm $spacing $spacing-lg;

    @include tablets() {
      padding: initial;
      overflow: hidden;
      position: relative;
      @include container-gradients($bg-color);
    }

    &-main {
      &--padded {
        padding-right: $spacing;
      }

      > article {
        margin-bottom: $spacing;

        @include tablets() {
          margin-bottom: $spacing-md;
        }
      }

      @include tablets() {
        padding-top: $spacing-lg;
        height: 100%;
        overflow-y: auto;
        box-sizing: border-box;
      }
    }
  }

  &__total {
    padding: $spacing;
    background-color: $silt;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    position: fixed;
    width: 100vw;
    box-sizing: border-box;
    bottom: 0;

    @include tablets() {
      width: initial;
      position: initial;
      padding: initial;
      background-color: initial;
      flex-direction: row-reverse;
      justify-content: flex-start;
      align-items: center;
    }

    &-price {
      display: flex;
      flex-direction: column;
      align-items: flex-end;

      @include tablets() {
        flex-direction: initial;
        align-items: center;
        margin-right: $spacing-lg;
      }

      > div:first-child {
        margin-bottom: $spacing-sm;
        font-size: 14px;
        font-weight: 400;

        @include tablets() {
          margin-right: $spacing-md;
          margin-bottom: initial;
          font-size: 24px;
        }
      }

      > div:last-child {
        font-size: 20px;
        color: $text-accent-color;

        @include tablets() {
          font-size: 36px;
          font-weight: 700;
        }

        span {
          font-size: 14px;

          @include tablets() {
            font-size: 24px;
          }
        }
      }
    }
  }
}
</style>
