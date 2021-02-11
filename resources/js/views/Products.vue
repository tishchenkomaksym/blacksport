<template>
  <PageLayout background-color="sole">
    <template v-slot:title>
      {{t('products')}}
    </template>
    <div class="products">
      <div class="products__categories">
        <div v-if="width < 1024">
          <button
            @click="categoryDropdownShown = !categoryDropdownShown"
            class="products__categories__category products__categories__category--active"
          >
            <span>{{currentCategory.name || t('selectCategory')}}</span>
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
              v-for="category in (currentCategory.id ? categories.filter(({id}) => id !== currentCategory.id) : categories)"
            >
              {{category.name}}
            </router-link>
          </div>
        </div>
        <div
          v-else
        >
          <h3 class="products__categories__title">{{t('productCategories')}}</h3>
          <div class="products__categories__list">
            <div :key="category.id" v-for="category in categories">
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

      <GradientContainer color="sole" class="products__list" v-if="width >= 1024 || !categoryDropdownShown">
        <template v-if="(route.query.category ? categoryProducts : products).length">
          <ProductItem
            :key="product.id"
            :data="product"
            v-for="product in (route.query.category ? categoryProducts : products)"
          />
        </template>
        <p v-else>{{t('emptyCategory')}}</p>
      </GradientContainer>
    </div>
  </PageLayout>
</template>

<script>
import {computed, ref, watch, watchEffect} from 'vue'
import {useRoute} from 'vue-router'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import {ROUTE_CONF} from '../router'
import useWindowSize from '../hooks/useWindowSize'

import PageLayout from '../components/Layout/PageLayout'
import ProductItem from '../components/Products/ProductItem'
import GradientContainer from '../components/Layout/GradientContainer'

export default {
  name: 'Products',
  components: {GradientContainer, ProductItem, PageLayout},
  setup() {
    const {dispatch, state} = useStore()
    const {t, locale} = useI18n()
    const route = useRoute()
    const {width} = useWindowSize()
    const categoryDropdownShown = ref(false)
    const products = computed(() => state.products.products) // List of all products
    const categories = computed(() => state.products.categories)
    const currentCategory = computed(() => { // Get active category object {id, name}
      return categories.value.find(({id}) => id === +route.query.category) || {}
    })
    const categoryProducts = computed(() => state.products.categoryProducts) // Products of a specific category

    watchEffect(() => {
      if (!route.query.category) dispatch('products/getProducts', locale.value)
      dispatch('products/getCategories', locale.value)
    })

    watch(() => route.query.category, categoryId => {
      if (categoryId) {
        categoryDropdownShown.value = false
        dispatch('products/getProductCategory', {categoryId, locale: locale.value})
      }
    }, {immediate: true})

    return {
      t,
      products,
      categories,
      currentCategory,
      categoryDropdownShown,
      categoryProducts,
      productCategoryPath: computed(() => ({
        name: ROUTE_CONF.PRODUCTS.name,
        params: {locale: locale.value},
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
@import "../assets/scss/page-helpers";

.products {
  @include laptop() {
    margin-top: #{-$spacing-lg};
    display: flex;
    align-items: flex-start;
  }

  &__categories {
    margin-bottom: $spacing;

    @include laptop() {
      width: 250px;
      margin-right: 47px;
      margin-bottom: initial;
    }

    &__category {
      width: 100%;
      display: block;
      padding: $spacing-sm / 2 0;
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
        padding: $spacing-sm $spacing 6px;
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
      @media screen and (max-width: 1023px) {
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
      margin-left: $spacing;
      color: $park;
    }
  }

  &__list {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: $spacing;

    @include tablets() {
      overflow-y: auto;
    }

    @include big-phones-landscape() {
      max-height: $page-height;
    }

    @include phones-tablets() {
      max-height: calc(#{$page-height} - #{$spacing-lg});
    }

    @include laptop() {
      max-height: calc(#{$page-height} + #{$spacing-lg});
      padding-top: $spacing-lg;
      grid-template-columns: repeat(3, 1fr);
      column-gap: $spacing-md;
      row-gap: $spacing-lg;
      box-sizing: border-box;
    }

    @include desktop() {
      grid-template-columns: repeat(4, 1fr);
    }
  }
}
</style>
