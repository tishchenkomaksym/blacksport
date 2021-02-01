<template>
  <div class="basket-list">
    <div class="basket-list__header">
      <h3>{{t('productList')}}</h3>
      <h3>{{t('quantity')}}</h3>
      <h3>{{t('price')}}</h3>
    </div>
    <div class="basket-list__body">
      <template v-if="productNumber > 0">
        <div class="basket-list__body-main">
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
import {computed} from 'vue'
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

    const proceedCheckout = () => emit('on-next-step')

    return {
      t,
      n,
      localeType,
      width,
      productIds,
      productNumber,
      proceedCheckout,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";
@import "../../assets/scss/page-helpers";

.basket-list {
  height: 100%;
  display: flex;
  flex-direction: column;

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
    padding: $spacing-sm $spacing 0;
    flex-grow: 1;
    overflow-y: auto;

    @include tablets() {
      padding: initial;
      overflow: hidden;
      position: relative;
      @include container-gradients($bg-color);
    }

    &-main {
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

    @include tablets() {
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