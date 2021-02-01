<template>
  <div class="home">
    <Hero v-show="currentSlide === 'hero'"/>
    <About
      @switch-slide="switchSlide"
      v-show="currentSlide === 'about'"
    />
    <News
      @switch-slide="switchSlide"
      :key="currentSlide === 'news'"
      v-show="currentSlide === 'news'"
    />
    <Services
      @switch-slide="switchSlide"
      v-show="currentSlide === 'services'"
    />
    <Products
      @switch-slide="switchSlide"
      :key="currentSlide === 'products'"
      v-show="currentSlide === 'products'"
    />
    <transition name="arrow-slide">
      <button
        @click="!!nextSlide ? switchSlide(nextSlide) : null"
        class="home__arrow-down"
        v-if="!!nextSlide"
      >
        <svg width="6" height="88" viewBox="0 0 6 88" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 88L6 72H1L1 0L0 0L0 72L0 88Z" fill="white"/>
        </svg>
      </button>
    </transition>
  </div>
</template>

<script>
import {computed, ref, watch, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import useWindowSize from '../hooks/useWindowSize'
import Hero from '../components/Home/Hero'
import About from '../components/Home/About'
import News from '../components/Home/News'
import Services from '../components/Home/Services'
import Products from '../components/Home/Products'

const SLIDE_ORDER = [
  'hero',
  'about',
  'news',
  'services',
  'products',
]

export default {
  name: 'Home',
  components: {Products, Services, News, About, Hero},
  setup() {
    const {dispatch} = useStore()
    const currentSlide = ref('hero')
    const {locale} = useI18n()
    const {width} = useWindowSize()

    watchEffect(() => {
      dispatch('home/getHomeData', locale.value)
    })

    const switchSlide = to => currentSlide.value = to

    const isArrowDownShown = computed(() => {
      return width.value < 768 ? currentSlide.value === 'hero' : true
    })

    watch(currentSlide, (to, from) => {
      console.log(`Going from ${from} slide to ${to} slide`)
    })

    return {
      currentSlide,
      switchSlide,
      isArrowDownShown,
      nextSlide: computed(() => SLIDE_ORDER[SLIDE_ORDER.findIndex(slide => currentSlide.value === slide) + 1]),
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/breakpoints";

.home {
  width: 100vw;
  height: 100vh;
  overflow: hidden;

  &__arrow-down {
    position: absolute;
    bottom: 18px;
    left: 50vw;
    transform: translateX(-50%);
    cursor: pointer;

    @include tablets() {
      bottom: 40px;
    }
  }
}

.arrow-slide {
  &-enter-active,
  &-leave-active {
    transition: all 1s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    transform: translate(-50%, 100%);
    bottom: 0;
  }
}
</style>
