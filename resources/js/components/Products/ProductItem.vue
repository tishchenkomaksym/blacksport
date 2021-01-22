<template>
  <article class="product-item">
    <!-- TODO change to dynamic image -->
    <router-link
      :to="productLink"
      :style="{backgroundImage: `url(https://loremflickr.com/1024/1024/sport_equipment)`}"
      class="product-item__image"
    />
    <div class="product-item__info">
      <div class="product-item__info-title">
        <router-link class="basic" :to="productLink">
          {{data.title}}
        </router-link>
      </div>
      <div class="product-item__info-price">{{price}} <span>₴</span></div>
    </div>
    <div class="product-item__button-wrapper">
      <transition name="order-button-slide">
        <Button
          block
          @click="addToBasket(data.id)"
          v-if="!isInBasket"
        >
          {{i18n.$t('defaults.buy')}}
        </Button>
      </transition>
      <transition name="ordered-button-slide">
        <Button
          block
          light
          v-if="isInBasket"
        >
          {{i18n.$t('defaults.openBasket')}}
        </Button>
      </transition>
    </div>
  </article>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import useWindowSize from '../../hooks/useWindowSize'
import {useI18n} from '../../i18nPlugin'
import {ROUTE_CONF} from '../../router'
import Button from '../Base/Button'

export default {
  name: 'ProductItem',
  components: {Button},
  props: {
    data: Object,
  },
  setup({data}) {
    const i18n = useI18n()
    const {dispatch, state} = useStore()
    const price = computed(() => {
      const locales = i18n.locale.value === 'ru' ? 'ru-RU' : i18n.locale.value === 'en' ? 'en-US' : 'uk-UA'
      return data.price.toLocaleString(locales)
    })
    const {width} = useWindowSize()
    const isInBasket = computed(() => {
      return !!Object.keys(state.products.basket).find(key => +key === data.id)
    })

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
      })),
      isInBasket,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.product-item {
  background-color: $silt;
  display: flex;
  flex-direction: column;

  &__image {
    display: block;
    width: 100%;
    padding-bottom: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: calc(100% - #{$spacing-lg + $spacing-sm});
    background-color: white;
    transition: background-size 0.3s ease-in-out;

    &:hover {
      background-size: calc(100% - 36px);
    }
  }

  &__info {
    padding: $spacing-sm;
    flex-grow: 1;

    @include laptop() {
      padding: $spacing $spacing-sm;
    }

    &-title {
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;

      @media (min-width: 375px) {
        -webkit-line-clamp: 4;
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

  &__button-wrapper {
    width: 100%;
    height: 36px;
    overflow: hidden;
    position: relative;

    @media screen and (max-width: 1023px) {
      button {
        padding-top: 10px;
        padding-bottom: 9px;
      }
    }

    @include laptop() {
      height: 52px;
    }
  }

  &__order-button {
    width: 100%;
    padding: $spacing-sm 0;
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
      padding: $spacing 0;
    }
  }
}

.order-button-slide,
.ordered-button-slide {
  &-enter-active,
  &-leave-active {
    width: 100%;
    transition: transform 0.3s ease-in-out;
    position: absolute;
  }
}

.order-button-slide {
  &-enter-from,
  &-leave-to {
    transform: translateY(-100%);
  }
}

.ordered-button-slide {
  &-enter-from,
  &-leave-to {
    transform: translateY(100%);
  }
}
</style>