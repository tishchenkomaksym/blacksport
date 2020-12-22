<template>
  <div class="home">
<!--    <transition-group-->
<!--      name="slide"-->
<!--    >-->
      <Hero key="hero" v-show="currentSlide === 0"/>
      <About key="about" v-show="currentSlide === 1" />
      <News
        @select-prev-section="switchSlide(false)"
        key="news" v-show="currentSlide === 2"
      />
<!--    </transition-group>-->
    <transition name="arrow-slide">
      <button
        @click="switchSlide"
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
import {computed, ref, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import useWindowSize from '../hooks/useWindowSize'
import Hero from '../components/Home/Hero'
import About from '../components/Home/About'
import News from '../components/Home/News'

export default {
  name: 'Home',
  components: {News, About, Hero},
  setup() {
    const {dispatch} = useStore()
    const currentSlide = ref(2)
    const i18n = useI18n()
    const {width} = useWindowSize()

    watchEffect(() => {
      dispatch('home/getHomeData', i18n.locale.value)
    })

    const switchSlide = (forward = true) => {
      if (forward) currentSlide.value += 1
      else currentSlide.value -= 1
    }

    const isArrowDownShown = computed(() => {
      return width.value < 768 ? currentSlide.value === 0 : true
    })

    return {
      currentSlide,
      switchSlide,
      isArrowDownShown,
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

.slide {
  &-enter-active,
  &-leave-active {
    transition: all 3s ease-in-out;
    position: absolute;
    width: 100%;
    height: 100%;
  }

  &-enter-to,
  &-leave-from {
    transform: translateY(0);
  }

  &-enter-from {
    transform: translateY(100%);
  }

  &-leave-to {
    transform: translateY(-100%);
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
