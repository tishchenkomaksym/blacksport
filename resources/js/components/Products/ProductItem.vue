<template>
  <article class="product-item">
    <!-- TODO change to dynamic image -->
    <div
      :style="{backgroundImage: `url(${'https://picsum.photos/1024'})`}"
      class="product-item__image"
    />
    <div class="product-item__info">
      <div class="product-item__info-title">{{data.title}}</div>
      <div class="product-item__info-price">{{price}} <span>₴</span></div>
    </div>
    <div class="product-item__order-button">
      <transition-group name="slide">
        <div
          @click="width < 768 ? addToBasket(data.id) : null"
          class="product-item__order-button-hoverable"
          key="hover"
        >
          {{i18n.$t('defaults.buy')}}
        </div>
      </transition-group>
    </div>
  </article>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import useWindowSize from '../../hooks/useWindowSize'
import {useI18n} from '../../i18nPlugin'

export default {
  name: 'ProductItem',
  props: {
    data: Object,
  },
  setup({data}) {
    const i18n = useI18n()
    const {dispatch} = useStore()
    const price = computed(() => {
      const locales = i18n.locale.value === 'ru' ? 'ru-RU' : i18n.locale.value === 'en' ? 'en-US' : 'uk-UA'
      return data.price.toLocaleString(locales)
    })
    const {width} = useWindowSize()

    const addToBasket = productId => {
      dispatch('products/addToBasket', {productId})
    }

    return {
      i18n,
      price,
      width,
      addToBasket,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.product-item {
  background-color: $silt;

  &__image {
    width: 100%;
    padding-bottom: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: calc(100% - 48px);
    background-color: white;
  }

  &__info {
    padding: 8px;

    @include laptop() {
      padding: 16px 8px;
    }

    &-title {
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;

      @media (min-width: 375px) {
        -webkit-line-clamp: 2;
      }
    }

    &-price {
      color: white;
      font-size: 18px;
      font-weight: 700;

      @include laptop() {
        margin-top: 16px;
      }

      span {
        font-size: 14px;
        font-weight: 300;
      }
    }
  }

  &__order-button {
    text-transform: uppercase;
    font-size: 18px;
    font-weight: 700;
    text-align: center;
    cursor: pointer;

    &-hoverable {
      padding: 8px 0;
      background-color: $smoke;

      @include laptop() {
        padding: 16px 0;
      }
    }
  }
}

.slide {

}
</style>