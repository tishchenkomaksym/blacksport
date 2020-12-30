<template>
  <article class="product-item">
    <!-- TODO change to dynamic image -->
    <router-link
      :to="productLink"
      :style="{backgroundImage: `url(${'https://picsum.photos/1024'})`}"
      class="product-item__image"
    />
    <div class="product-item__info">
      <div class="product-item__info-title">
        <router-link class="basic" style="transition: none" :to="productLink">
          {{data.title}}
        </router-link>
      </div>
      <div class="product-item__info-price">{{price}} <span>₴</span></div>
    </div>
    <button
      @click="addToBasket(data.id)"
      class="product-item__order-button"
    >
      {{i18n.$t('defaults.buy')}}
    </button>
  </article>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import useWindowSize from '../../hooks/useWindowSize'
import {useI18n} from '../../i18nPlugin'
import {ROUTE_CONF} from '../../router'

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
      productLink: computed(() => ({
        name: ROUTE_CONF.PRODUCT.name,
        params: {locale: i18n.locale.value, id: data.id},
      }))
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
    display: block;
    width: 100%;
    padding-bottom: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: calc(100% - 48px);
    background-color: white;
    transition: background-size 0.3s ease-in-out;

    &:hover {
      background-size: calc(100% - 36px);
    }
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
    width: 100%;
    padding: 8px 0;
    display: block;
    text-transform: uppercase;
    font-size: 18px;
    font-weight: 700;
    text-align: center;
    cursor: pointer;
    color: $text-color;
    background-color: $smoke;
    transition: background-color 0.3s ease-in-out;

    &:hover {
      background-color: $park;
    }

    @include laptop() {
      padding: 16px 0;
    }
  }
}

.slide {

}
</style>