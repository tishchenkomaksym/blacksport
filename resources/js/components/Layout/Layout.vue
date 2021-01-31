<template>
  <transition name="overlay-transition">
    <div
      :class="{'overlay--dark': basketOpen}"
      @click="basketOpen ? closeBasket() : toggleMenu()"
      class="overlay"
      v-if="isBlurred"
    />
  </transition>
  <Header/>
  <BasketPopup v-if="basketOpen" />
  <main
    :class="{blurred: isBlurred}"
    :style="{backgroundColor}"
  >
    <slot/>
  </main>
  <Footer/>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'

import Header from './Header'
import Footer from './Footer'
import BasketPopup from '../Products/BasketPopup'

export default {
  name: 'Layout',
  components: {BasketPopup, Header, Footer},
  props: {
    backgroundColor: String,
  },
  setup() {
    const {commit, state} = useStore()
    const menuShown = computed(() => state.common.menuShown)
    const basketOpen = computed(() => state.common.basketOpen)
    const isBlurred = computed(() => menuShown.value || basketOpen.value)

    const toggleMenu = () => commit('common/toggleMenu')

    const closeBasket = () => commit('common/setBasketOpen', false)

    return {
      basketOpen,
      isBlurred,
      toggleMenu,
      closeBasket,
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

main {
  transition: filter 0.3s ease-in-out;

  &.blurred {
    filter: blur(16px);
  }
}

.overlay {
  width: 100vw;
  height: 100vh;
  position: absolute;
  z-index: 1;
  transition: background-color 0.3s ease-in-out;
  background-color: rgba($bg-color, 0.5);

  &--dark {
    background-color: rgba($bg-color, 1);
  }
}

.overlay-transition {
  &-enter-active,
  &-leave-active {
    transition: opacity 0.3s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
  }
}
</style>
