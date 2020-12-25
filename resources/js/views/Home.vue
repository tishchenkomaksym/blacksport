<template>
  <div class="home">
    <Hero v-show="currentSlide === 'hero'"/>
    <About
      @select-prev-section="switchSlide('hero')"
      v-show="currentSlide === 'about'"
    />
    <News
      @select-prev-section="switchSlide('about')"
      :key="currentSlide"
      v-show="currentSlide === 'news'"
    />
    <Services
      @select-prev-section="switchSlide('news')"
      v-show="currentSlide === 'services'"
    />
    <transition name="arrow-slide">
      <button
        @click="switchSlide(nextSlide)"
        class="home__arrow-down"
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
import {useI18n} from '../i18nPlugin'
import useWindowSize from '../hooks/useWindowSize'
import Hero from '../components/Home/Hero'
import About from '../components/Home/About'
import News from '../components/Home/News'
import Services from '../components/Home/Services'

const SLIDE_ORDER = [
  'hero',
  'about',
  'news',
  'services',
]

export default {
  name: 'Home',
  components: {Services, News, About, Hero},
  setup() {
    const {dispatch} = useStore()
    const currentSlide = ref('services')
    const i18n = useI18n()
    const {width} = useWindowSize()

    watchEffect(() => {
      dispatch('home/getHomeData', i18n.locale.value)
    })

    const switchSlide = to => currentSlide.value = to

    const isArrowDownShown = computed(() => {
      return width.value < 768 ? currentSlide.value === 'hero' : true
    })

    watch(() => currentSlide.value, (to, from) => {
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
