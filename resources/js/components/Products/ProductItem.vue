<template>
  <article class="product-item">
    <router-link
      :to="productLink"
      :title="data.title"
      class="product-item__image"
    >
      <img :src="image" :alt="data.title" />
    </router-link>
    <div class="product-item__info">
      <div class="product-item__info-title">
        <router-link class="basic" :to="productLink">
          {{data.title}}
        </router-link>
      </div>
      <div class="product-item__info-price">{{n(data.price, 'price', localeType)}} <span>₴</span></div>
    </div>
    <div class="product-item__button-wrapper">
      <transition name="order-button-slide">
        <Button
          block
          @click="addToBasket(data.id)"
          v-if="!isInBasket"
        >
          {{t('buy')}}
        </Button>
      </transition>
      <transition name="ordered-button-slide">
        <Button
          @click="openBasket"
          block
          light
          v-if="isInBasket"
        >
          {{t('openBasket')}}
        </Button>
      </transition>
    </div>
  </article>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import useWindowSize from '../../hooks/useWindowSize'
import {useI18n} from 'vue-i18n'
import useImageStorage from '../../hooks/useImageStorage'
import {ROUTE_CONF} from '../../router'
import Button from '../Base/Button'

export default {
  name: 'ProductItem',
  components: {Button},
  props: {
    data: Object,
  },
  setup({data}) {
    const {t, locale, n} = useI18n()
    const {commit, dispatch, state} = useStore()
    const localeType = computed(() => locale.value === 'ru' ? 'ru-RU' : locale.value === 'en' ? 'en-US' : 'uk-UA')
    const {width} = useWindowSize()
    const isInBasket = computed(() => {
      return !!Object.keys(state.products.basket).find(key => +key === data.id)
    })
    const image = useImageStorage(data.image, true)

    const addToBasket = productId => {
      dispatch('products/addToBasket', {productId})
    }

    const openBasket = () => commit('common/setBasketOpen', true)

    return {
      t,
      n,
      localeType,
      width,
      addToBasket,
      openBasket,
      productLink: computed(() => ({
        name: ROUTE_CONF.PRODUCT.name,
        params: {locale: locale.value, id: data.id},
      })),
      isInBasket,
      image,
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
    height: 0;
    width: 100%;
    padding-bottom: 100%;
    position: relative;
    background-color: white;
    transition: background-size 0.3s ease-in-out;

    &:hover {
      img {
        width: calc((100vw * 118) / 320);
        height: calc((100vw * 118) / 320);
      }

      @include laptop() {
        img {
          width: 200px;
          height: 200px;
        }
      }
    }

    img {
      width: calc((100vw * 112) / 320);
      height: calc((100vw * 112) / 320);
      object-fit: cover;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      transition: all 0.3s ease-in-out;

      @include laptop() {
        width: 184px;
        height: 184px;
      }
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