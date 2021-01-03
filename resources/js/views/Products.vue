<template>
  <PageLayout
    :title="i18n.$t('defaults.products')"
    background-color="sole"
  >
    <div class="products">
      <div class="products__categories">
        <div v-if="width < 1024">
          <button
            @click="categoryDropdownShown = !categoryDropdownShown"
            class="products__categories__category products__categories__category--active"
          >
            <span>{{currentCategory.name || i18n.$t('defaults.selectCategory')}}</span>
            <svg
              :class="{'products__categories__category-arrow--opened': categoryDropdownShown}"
              class="products__categories__category-arrow"
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
          </button>
          <div
            class="products__categories__list"
            v-if="categoryDropdownShown"
          >
            <router-link
              :key="category.id"
              :to="{...productCategoryPath, query: {category: category.id}}"
              replace
              class="products__categories__category"
              v-for="category in (currentCategory.id ? productCategories.filter(({id}) => id !== currentCategory.id) : productCategories)"
            >
              {{category.name}}
            </router-link>
          </div>
        </div>
        <div
          v-else
        >
          <h3 class="products__categories__title">{{i18n.$t('defaults.productCategories')}}</h3>
          <div class="products__categories__list">
            <div :key="category.id" v-for="category in productCategories">
              <router-link
                :class="{'products__categories__category--active': +route.query.category === category.id}"
                :to="{...productCategoryPath, query: {category: category.id}}"
                class="products__categories__category"
              >
                {{category.name}}
              </router-link>
            </div>
          </div>
        </div>
      </div>

      <div class="products__list" v-if="width >= 1024 || !categoryDropdownShown">
        <template v-if="(route.query.category ? categoryProducts : products).length">
          <ProductItem
            :key="product.id"
            :data="product"
            v-for="product in (route.query.category ? categoryProducts : products)"
          />
        </template>
        <p v-else>{{i18n.$t('defaults.emptyCategory')}}</p>
      </div>
    </div>
  </PageLayout>
</template>

<script>
import {computed, ref, watch, watchEffect} from 'vue'
import {useRoute} from 'vue-router'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import {ROUTE_CONF} from '../router'
import useWindowSize from '../hooks/useWindowSize'
import PageLayout from '../components/Layout/PageLayout'
import ProductItem from '../components/Products/ProductItem'

export default {
  name: 'Products',
  components: {ProductItem, PageLayout},
  setup() {
    const {dispatch, getters, state} = useStore()
    const i18n = useI18n()
    const route = useRoute()
    const {width} = useWindowSize()
    const categoryDropdownShown = ref(false)
    const products = computed(() => state.products.products) // List of all products
    const productCategories = computed(() => getters['products/productCategories']) // List of existing categories
    const currentCategory = computed(() => { // Get active category object {id, name}
      return productCategories.value.find(({id}) => id === +route.query.category) || {}
    })
    const categoryProducts = computed(() => state.products.categoryProducts) // Products of a specific category

    watchEffect(() => {
      dispatch('products/getProducts', i18n.locale.value)
    })

    watch(() => route.query.category, categoryId => {
      if (categoryId) {
        categoryDropdownShown.value = false
        dispatch('products/getProductCategory', {categoryId, locale: i18n.locale.value})
      }
    }, {immediate: true})

    return {
      i18n,
      products,
      productCategories,
      currentCategory,
      categoryDropdownShown,
      categoryProducts,
      productCategoryPath: computed(() => ({
        name: ROUTE_CONF.PRODUCTS.name,
        params: {locale: i18n.locale.value},
      })),
      width,
      route,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";

.products {
  @include laptop() {
    display: flex;
    align-items: flex-start;
  }

  &__categories {
    margin-bottom: 15px;

    @include laptop() {
      width: 250px;
      margin-right: 47px;
      margin-bottom: initial;
    }

    &__category {
      width: 100%;
      display: block;
      padding: 4px 0;
      color: $text-color;
      text-transform: uppercase;
      font-weight: 700;
      text-align: left;
      transition: color 0.3s ease-in-out;

      &:hover, &--active {
        color: $text-accent-color;
      }

      &--active {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      &-arrow {
        fill: $text-color;

        &--opened {
          transform: scaleY(-1);
        }
      }

      @include laptop() {
        width: auto;
        display: inline-block;
        padding: 8px 16px 6px;
        position: relative;

        &::after {
          top: 0;
          left: 0;
          content: '';
          display: block;
          position: absolute;
          width: 100%;
          height: 100%;
          background-image: url("data:image/svg+xml,%3csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' stroke='%23D9D9D9FF' stroke-width='2' stroke-dasharray='8%2c 8' stroke-dashoffset='0' stroke-linecap='square'/%3e%3c/svg%3e");
          opacity: 0;
          transition: opacity 0.3s ease-in-out;
        }

        &:hover, &--active {
          &::after {
            opacity: 1;
          }
        }
      }
    }

    &__list {
      @media screen and (max-width: 767px) {
        > a {
          margin: 18px 0;
        }
      }

      @include laptop() {
        max-height: 70vh;
        overflow-y: auto;

        > div {
          margin: 0 0 18px;
        }
      }
    }

    &__title {
      margin-top: 0;
      margin-left: 16px;
      color: $park;
    }
  }

  &__list {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 16px;

    @include laptop() {
      max-height: calc((610 * 100vh) / 900);
      overflow-y: auto;
      padding-top: 40px;
      grid-template-columns: repeat(3, 1fr);
      column-gap: 24px;
      row-gap: 40px;
      padding-right: 8px;

      &::before, &::after {
        width: calc(100vw - 80px - 202px - 47px);
        max-width: calc(1440px - 80px - 202px - 47px - 8px);
        height: 40px;
        content: '';
        display: block;
        position: absolute;
      }

      &::before {
        top: 146px;
        background: linear-gradient(180deg, #0D0D0D 0%, rgba(13, 13, 13, 0) 100%);
      }

      &::after {
        top: calc(146px + (610 * 100vh) / 900);
        background: linear-gradient(180deg, rgba(13, 13, 13, 0) 0%, #0D0D0D 100%);
      }
    }

    @include desktop() {
      grid-template-columns: repeat(4, 1fr);
    }
  }
}
</style>
