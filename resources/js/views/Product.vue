<template>
  <PageLayout
    :title="`${t('products')} • ${productCategory || ''}`"
    background-color="sole"
  >
    <div class="product">
      <router-link
        :to="allProductsPath"
        class="link product__back-link"
      >
        <svg
          class="product__back-link__arrow"
          width="16"
          height="9"
          viewBox="0 0 16 9"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M8.00019 8.80005C7.83201 8.80005 7.67155 8.72946 7.5579 8.60548L0.957898 1.40548C0.733982 1.16121 0.750484 0.781672 0.994756 0.557756C1.23903 0.333841 1.61857 0.350342 1.84248 0.594613L8.00019 7.31211L14.1579 0.594614C14.3818 0.350342 14.7614 0.33384 15.0056 0.557756C15.2499 0.781672 15.2664 1.16121 15.0425 1.40548L8.44249 8.60548C8.32884 8.72946 8.16838 8.80005 8.00019 8.80005Z"
          />
        </svg>
        <span>{{t('toProducts')}}</span>
      </router-link>

      <div class="product__grid">
        <div
          :style="{backgroundImage: `url(${image})`}"
          class="product__image"
        />
        <div class="product__ordering">
          <div class="product__ordering-price">{{price}} <span>₴</span></div>
          <button
            :class="{'product__ordering-buy--ordered': isInBasket}"
            @click="!isInBasket ? addToBasket() : null"
            class="product__ordering-buy"
          >
            {{t(isInBasket ? 'openBasket' : 'buy')}}
          </button>
        </div>
        <div class="product__description">
          <h2>{{product.title}}</h2>
          <h3>{{t('productDescription')}}</h3>
          <p
            :key="i"
            v-for="(paragraph, i) in descriptionParagraphs"
          >
            {{paragraph}}
          </p>
        </div>
        <div class="product__specifications">
          <h2>{{t('specifications')}}</h2>
          <p
            :key="i"
            class="product__specifications-item"
            v-for="(paragraph, i) in specificationParagraphs"
          >
            <span>{{paragraph.split(':')[0]}}</span>
            <span>{{paragraph.split(':')[1]}}</span>
          </p>
        </div>
      </div>
    </div>
  </PageLayout>
</template>

<script>
import {computed, ref, watch, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useRoute} from 'vue-router'
import {useI18n} from 'vue-i18n'
import useImageStorage from '../hooks/useImageStorage'
import useParseText from '../hooks/useParseText'
import PageLayout from '../components/Layout/PageLayout'
import {ROUTE_CONF} from '../router'

export default {
  name: 'Product',
  components: {PageLayout},
  setup() {
    const {t, locale} = useI18n()
    const route = useRoute()
    const {state, dispatch} = useStore()
    const product = ref({})
    const productCategory = computed(() => product.value.categories?.name)
    const price = computed(() => {
      const locales = locale.value === 'ru' ? 'ru-RU' : locale.value === 'en' ? 'en-US' : 'uk-UA'
      return (product.value.price || '').toLocaleString(locales)
    })
    const isInBasket = computed(() => {
      return !!Object.keys(state.products.basket).find(key => +key === product.value.id)
    })

    const image = computed(() => useImageStorage(product.value?.image || '', true).value)

    const description = computed(() => product.value?.description || '')
    const descriptionParagraphs = computed(() => useParseText(description.value).value)

    const specifications = computed(() => product.value?.specifications || '')
    const specificationParagraphs = computed(() => useParseText(specifications.value).value)

    watchEffect(async () => {
      product.value = await dispatch('products/getProduct', { id: route.params.id, locale: locale.value }) || {}
    })

    watch(product, product => {
      if (product?.title) document.title = `Blacksport | ${product.title}`
    })

    const addToBasket = () => {
      dispatch('products/addToBasket', {productId: product.value.id})
    }

    return {
      t,
      product,
      productCategory,
      image,
      descriptionParagraphs,
      specificationParagraphs,
      price,
      addToBasket,
      isInBasket,
      allProductsPath: computed(() => ({
        name: ROUTE_CONF.PRODUCTS.name,
        params: {locale: locale.value},
      }))
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";

.product {
  &__back-link {
    display: inline-block;
    margin-bottom: 10px;

    @include tablets() {
      margin-bottom: 37px;
    }

    &__arrow {
      margin-right: $spacing;
      fill: $text-color;
      transform: rotate(90deg) translateX(-2px);
    }
  }

  &__image {
    width: 100%;
    padding-bottom: 100%;
    margin-bottom: $spacing;
    background-position: center;
    background-repeat: no-repeat;
    background-size: calc(100% - 48px);
    background-color: white;

    @include tablets() {
      margin-bottom: initial;
      grid-row: 1 / span 2;
      align-self: start;
    }
  }

  &__ordering {
    display: flex;
    align-items: center;
    justify-content: space-between;

    &-price {
      font-size: $spacing-md + $spacing-sm / 2;
      font-weight: 700;

      span {
        font-size: 20px;
        font-weight: 400;
      }
    }

    &-buy {
      padding: $spacing $spacing-md;
      font-weight: 700;
      color: $text-color;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      background-color: $smoke;
      transition: background-color 0.3s ease-in-out;

      &:hover {
        background-color: $park;
      }

      &--ordered {
        background-color: $text-color;
        color: $smoke;
      }
    }
  }

  &__description {
    h3 {
      color: $park;
      letter-spacing: 0.08em;
    }

    @include tablets() {
      grid-column: 2;
      grid-row: 1;

      h2 {
        margin-top: 0;
      }
    }
  }

  &__specifications {
    @include tablets() {
      grid-row: 3;
      grid-column: 1 / span 2;

      h2 {
        margin-top: 0;
      }
    }

    @include desktop() {
      grid-row: 1 / span 2;
      grid-column: 3;
    }

    &-item {
      display: grid;
      grid-template-columns: 175px 1fr;
      column-gap: $spacing;

      span:first-of-type {
        color: $text-color;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 14px;
        font-weight: 300;
      }
    }
  }

  &__grid {
    @include tablets() {
      display: grid;
      grid-template-columns: 330px 1fr;
      grid-template-rows: 1fr 50px 1fr;
      column-gap: $spacing-md;
    }

    @include desktop() {
      grid-template-columns: 440px 1fr 1fr;
      grid-template-rows: minmax(390px, 1fr) 50px;
    }

    @include large-desktop() {
      column-gap: $spacing-lg;
    }
  }
}
</style>