<template>
  <section class="products">
    <PrevSectionButton
      :title="i18n.$t('defaults.services')"
      @click="$emit('switch-slide', 'services')"
    />
    <div class="products__content">
      <div class="products__heading container">
        <h2>{{i18n.$t('defaults.popularProducts')}}</h2>
        <router-link
          :to="productsPath"
          class="link subtitle"
        >
          {{allProducts}}
        </router-link>
      </div>
      <div class="glide products__list" ref="productsSlider">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li
              :key="productItem.id"
              :style="{maxWidth: '253px'}"
              class="glide__slide"
              v-for="productItem in products.slice(0, 5)"
            >
              <ProductItem :data="productItem" />
            </li>
          </ul>
        </div>
      </div>
      <PrevSectionButton
        :title="i18n.$t('defaults.up')"
        @click="$emit('switch-slide', 'hero')"
        style="margin-bottom: 48px"
      />
    </div>
  </section>
</template>

<script>
import {computed, nextTick, onMounted, ref, watch} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../../i18nPlugin'
import {ROUTE_CONF} from '../../router'
import useWindowSize from '../../hooks/useWindowSize'
import PrevSectionButton from './PrevSectionButton'
import ProductItem from '../Products/ProductItem'
import Glide from '@glidejs/glide'

export default {
  name: 'Products',
  components: {ProductItem, PrevSectionButton},
  setup() {
    const {state} = useStore()
    const i18n = useI18n()
    const {width} = useWindowSize()
    const products = computed(() => state.home.homeData.popular_products)
    const glide = ref(null)
    const productsSlider = ref(null)

    const mountGlide = () => {
      glide.value = new Glide(productsSlider.value, {
        perView: 5,
        gap: 24,
        bound: true,
        peek: {before: 40, after: 0},
        breakpoints: {
          1439: {
            perView: 3,
            gap: 16,
          },
          968: {
            perView: 2,
          },
          768: {
            perView: 1,
            gap: 16,
            peek: {before: 40, after: 0},
          },
          450: {
            perView: 1,
            peek: {before: 16, after: 104},
          },
        },
      })
        .on('resize', refreshGlide)
      glide.value.mount()
    }

    const destroyGlide = () => {
      if (glide.value) {
        glide.value.destroy()
        glide.value = null
      }
    }

    const refreshGlide = async () => {
      destroyGlide()
      await nextTick()
      mountGlide()
    }

    onMounted(() => {
      mountGlide()
    })

    watch(() => products.value, () => {
      if (productsSlider.value) {
        refreshGlide()
      }
    })

    return {
      i18n,
      productsSlider,
      products,
      productsPath: computed(() => ({
        name: ROUTE_CONF.PRODUCTS.name,
        params: {locale: i18n.locale.value},
      })),
      allProducts: computed(() => {
        return width.value < 768 ? (
          i18n.$t('defaults.allProducts').split(' ')[0]
        ) : (
          i18n.$t('defaults.allProducts')
        )
      })
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.products {
  height: 100%;
  display: flex;
  background-color: $smoke;
  flex-direction: column;
  justify-content: flex-end;

  &__content {
    margin-top: 16px;
    height: 77vh;
    background-color: $sole;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;

    @include laptop() {
      margin-top: 40px;
      height: 84vh;
    }
  }

  .container {
    @include tablets() {
      padding: 0 40px;
    }

    @include laptop() {
      padding: 40px 40px 0;
    }
  }

  &__heading {
    display: flex;
    align-items: center;
    justify-content: space-between;

    h2 {
      @include laptop() {
        margin: 0;
        font-size: 36px;
        font-weight: 700;
      }
    }
  }

  &__list {
    margin-bottom: 16px;
    flex-grow: 1;

    @include laptop() {
      max-width: 1440px;
      margin: 40px auto;
      //padding: 0 48px;
    }

    @include desktop() {
      margin: 40px auto 125px;
    }
  }
}
</style>