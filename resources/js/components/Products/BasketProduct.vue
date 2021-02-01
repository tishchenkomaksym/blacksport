<template>
  <article class="basket-product">
    <router-link
      :to="productLink"
      @click.prevent="openProduct"
      :style="{backgroundImage: `url(${image})`}"
      class="basket-product__image"
    />
    <router-link
      :to="productLink"
      @click.prevent="openProduct"
      class="basic basket-product__title"
    >
      {{product.title}}
    </router-link>

    <div class="basket-product__quantity">
      <button
        :disabled="isLoading || productCount === 1"
        @click="changeQuantity(-1)"
        class="basket-product__quantity__decrease-button"
      >
        <svg viewBox="0 0 14 2" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M13.5996 1.00002C13.5996 1.3314 13.331 1.60002 12.9996 1.60002L11.1996 1.60002C10.8682 1.60002 10.5996 1.3314 10.5996 1.00002C10.5996 0.668654 10.8682 0.400024 11.1996 0.400024L12.9996 0.400024C13.331 0.400024 13.5996 0.668654 13.5996 1.00002ZM9.39961 1.00002C9.39961 1.3314 9.13098 1.60002 8.79961 1.60002L0.99961 1.60002C0.66824 1.60002 0.39961 1.3314 0.399611 1.00002C0.399611 0.668653 0.66824 0.400024 0.99961 0.400024L8.79961 0.400024C9.13098 0.400024 9.39961 0.668654 9.39961 1.00002Z"
          />
        </svg>
      </button>

      <span>{{productCount}}</span>

      <button
        :disabled="isLoading || productCount === 99"
        @click="changeQuantity(+1)"
        class="basket-product__quantity__increase-button"
      >
        <svg viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M13.5996 7.00002C13.5996 7.3314 13.331 7.60002 12.9996 7.60002L11.1996 7.60002C10.8682 7.60002 10.5996 7.3314 10.5996 7.00002C10.5996 6.66865 10.8682 6.40002 11.1996 6.40002L12.9996 6.40002C13.331 6.40002 13.5996 6.66865 13.5996 7.00002ZM9.39961 7.00002C9.39961 7.3314 9.13098 7.60002 8.79961 7.60002L7.59961 7.60002L7.59961 13C7.59961 13.3314 7.33098 13.6 6.99961 13.6C6.66824 13.6 6.39961 13.3314 6.39961 13L6.39961 7.60002L0.99961 7.60002C0.668239 7.60002 0.39961 7.33139 0.39961 7.00002C0.39961 6.66865 0.668239 6.40002 0.99961 6.40002L6.39961 6.40002L6.39961 1.00002C6.39961 0.668653 6.66824 0.400024 6.99961 0.400024C7.33098 0.400024 7.59961 0.668653 7.59961 1.00002L7.59961 6.40002L8.79961 6.40002C9.13098 6.40002 9.39961 6.66865 9.39961 7.00002Z"
          />
        </svg>
      </button>
    </div>

    <div class="basket-product__price">
      {{n(totalPrice, 'price', localeType)}} <span>₴</span>
    </div>

    <button
      :disabled="isLoading"
      @click="deleteProduct"
      class="basket-product__delete-button"
    >
      <svg viewBox="0 0 12 14" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M11.8243 1.77576C11.9368 1.88828 12 2.04089 12 2.20002L12 4.60002C12 4.93139 11.7314 5.20002 11.4 5.20002L10.2 5.20002L10.2 13C10.2 13.1592 10.1368 13.3118 10.0243 13.4243C9.91174 13.5368 9.75913 13.6 9.6 13.6L2.4 13.6C2.06863 13.6 1.8 13.3314 1.8 13C1.8 12.6687 2.06863 12.4 2.4 12.4L9 12.4L9 4.60002C9 4.44089 9.06321 4.28828 9.17574 4.17576C9.28826 4.06324 9.44087 4.00002 9.6 4.00002L10.8 4.00002L10.8 2.80002L7.2 2.80002C7.04087 2.80002 6.88826 2.73681 6.77574 2.62429C6.66321 2.51177 6.6 2.35915 6.6 2.20002L6.6 1.60002L5.4 1.60002L5.4 2.20002C5.4 2.53139 5.13137 2.80002 4.8 2.80002L1.2 2.80002L1.2 4.00002L2.4 4.00002C2.55913 4.00002 2.71174 4.06324 2.82426 4.17576C2.93679 4.28828 3 4.44089 3 4.60002L3 10L4.2 10L4.2 4.60002C4.2 4.26865 4.46863 4.00002 4.8 4.00002L7.2 4.00002C7.35913 4.00002 7.51174 4.06324 7.62426 4.17576C7.73679 4.28828 7.8 4.44089 7.8 4.60002L7.8 10.6C7.8 10.9314 7.53137 11.2 7.2 11.2C6.86863 11.2 6.6 10.9314 6.6 10.6L6.6 5.20002L5.4 5.20002L5.4 10.6C5.4 10.7592 5.33679 10.9118 5.22426 11.0243C5.11174 11.1368 4.95913 11.2 4.8 11.2L2.4 11.2C2.06863 11.2 1.8 10.9314 1.8 10.6L1.8 5.20002L0.599999 5.20002C0.440869 5.20002 0.288257 5.13681 0.175735 5.02429C0.0632132 4.91177 -1.90544e-07 4.75915 -1.83588e-07 4.60002L-7.86805e-08 2.20002C-6.41958e-08 1.86865 0.268629 1.60002 0.599999 1.60002L4.2 1.60002L4.2 1.00002C4.2 0.668653 4.46863 0.400024 4.8 0.400024L7.2 0.400024C7.53137 0.400024 7.8 0.668653 7.8 1.00002L7.8 1.60002L11.4 1.60002C11.5591 1.60002 11.7117 1.66324 11.8243 1.77576Z"
        />
      </svg>
    </button>
  </article>
</template>

<script>
import {computed, ref, watch} from 'vue'
import {useStore} from 'vuex'
import {useRouter} from 'vue-router'
import {useI18n} from 'vue-i18n'
import useImageStorage from '../../hooks/useImageStorage'
import {ROUTE_CONF} from '../../router'

export default {
  name: 'BasketProduct',
  props: {
    productId: {
      type: [Number, String],
      required: true,
    },
  },
  setup({productId}) {
    const {commit, dispatch, state} = useStore()
    const {locale, n} = useI18n()
    const router = useRouter()
    const localeType = computed(() => locale.value === 'ru' ? 'ru-RU' : locale.value === 'en' ? 'en-US' : 'uk-UA')
    const product = ref({})
    const basket = computed(() => state.products.basket)
    const isLoading = ref(false)
    const productCount = computed(() => basket.value[productId])
    const totalPrice = computed(() => (product.value?.price || 0) * productCount.value)
    const image = computed(() => useImageStorage(product.value?.image, true).value)
    const productLink = computed(() => ({
      name: ROUTE_CONF.PRODUCT.name,
      params: {locale: locale.value, id: productId},
    }))

    watch(locale, async (locale) => {
      product.value = await dispatch('products/getProduct', {productId, locale})
    }, {immediate: true})

    const openProduct = () => {
      commit('common/setBasketOpen', false)
      router.push(productLink.value)
    }

    const updateProduct = async (callback) => {
      try {
        isLoading.value = true
        await callback()
      } catch (err) {
        console.error(err)
      }
      isLoading.value = false
    }

    const changeQuantity = count => {
      updateProduct(() => dispatch('products/updateBasket', {productId, count: productCount.value + count}))
    }

    const deleteProduct = () => {
      updateProduct(() => dispatch('products/deleteFromBasket', productId))
    }

    return {
      n,
      localeType,
      isLoading,
      image,
      product,
      productLink,
      productCount,
      totalPrice,
      openProduct,
      changeQuantity,
      deleteProduct,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.basket-product {
  display: grid;
  grid-template-columns: calc((80 * 100vw) / 320) 1fr auto;
  column-gap: $spacing-sm;
  row-gap: $spacing-sm;
  align-items: flex-start;

  @include tablets() {
    align-items: center;
    grid-template-columns: 120px 1fr 155px 160px auto;
    column-gap: $spacing-md;
  }

  svg {
    transition: fill 0.3s ease-in-out;
  }

  &__image {
    display: block;
    width: 100%;
    padding-bottom: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: calc(100% - #{$spacing - $spacing-sm / 2});
    background-color: white;
    transition: background-size 0.3s ease-in-out;

    &:hover {
      background-size: calc(100% - #{$spacing-sm});
    }
  }

  &__title {
    @include tablets() {
      max-width: 540px;
      font-size: 24px;
      line-height: 32px;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
  }

  &__quantity {
    color: $text-accent-color;
    display: grid;
    grid-template-columns: auto 1fr auto;
    justify-items: center;
    align-items: center;

    @include tablets() {
      column-gap: $spacing-md;

      span {
        font-size: 24px;
      }
    }

    &__increase-button,
    &__decrease-button {
      padding: 5px;
      font-size: 0;

      &:not(:disabled):hover svg {
        fill: $text-color;
      }

      @include tablets() {
        padding: 9px;
      }

      svg {
        width: 14px;
        height: 14px;
        fill: $park;

        @include tablets() {
          width: 22px;
          height: 22px;
        }
      }
    }
  }

  &__price {
    height: 100%;
    color: $text-accent-color;
    grid-column: 2 span;
    display: flex;
    align-items: center;
    justify-content: flex-end;

    @include tablets() {
      height: initial;
      grid-column: initial;
      align-items: baseline;
      justify-content: center;
      font-size: 24px;
      position: relative;

      &::before,
      &::after {
        content: "";
        display: block;
        height: 40px;
        width: 2px;
        background-color: $park;
        border-radius: 2px;
        position: absolute;
        top: -100%;
        transform: translateY(50%);
      }

      &::before {
        left: 0;
      }

      &::after {
        right: 0;
      }
    }

    span {
      margin-left: $spacing-sm / 2;
      font-size: 10px;
      font-weight: 300;

      @include tablets() {
        font-size: 14px;
      }
    }
  }

  &__delete-button {
    padding: 3.5px 4.5px;
    grid-row: 1;
    grid-column: 3;
    font-size: 0;

    &:hover svg {
      fill: $text-accent-color;
    }

    @include tablets() {
      padding: 10px 9px;
      grid-row: initial;
      grid-column: initial;
    }

    svg {
      width: 15px;
      height: 17px;
      fill: $text-color;

      @include tablets() {
        width: 22px;
        height: 20px;
      }
    }
  }
}
</style>