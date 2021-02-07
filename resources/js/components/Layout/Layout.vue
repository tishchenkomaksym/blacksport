<template>
  <transition name="overlay-transition">
    <div
      :class="{'overlay--dark': basketOpen}"
      @click="closeEverything"
      class="overlay"
      v-if="isBlurred"
    />
  </transition>
  <Header/>
  <BasketPopup v-if="basketOpen" />
  <transition name="modal-transition">
    <ServiceExamplesModal
      :current-example="shownServiceExample.example"
      :examples="shownServiceExample.examples"
      @close-modal="closeEverything"
      v-if="shownServiceExample"
    />
  </transition>
  <transition name="modal-transition">
    <ServiceOrderModal
      :service-id="shownServiceOrder.id"
      :service-name="shownServiceOrder.name"
      @close-modal="closeEverything"
      v-if="shownServiceOrder"
    />
  </transition>
  <main
    :class="{blurred: isBlurred}"
    :style="{backgroundColor}"
  >
    <slot/>
  </main>
  <Footer/>
</template>

<script>
import {computed, watch} from 'vue'
import {useStore} from 'vuex'

import Header from './Header'
import Footer from './Footer'
import BasketPopup from '../Products/BasketPopup'
import ServiceExamplesModal from '../Services/ServiceExamplesModal'
import ServiceOrderModal from '../Services/ServiceOrderModal'

export default {
  name: 'Layout',
  components: {ServiceOrderModal, ServiceExamplesModal, BasketPopup, Header, Footer},
  props: {
    backgroundColor: String,
  },
  setup() {
    const {dispatch, getters, state} = useStore()
    const basketOpen = computed(() => state.common.basketOpen)
    const shownServiceExample = computed(() => state.common.shownServiceExample)
    const shownServiceOrder = computed(() => state.common.shownServiceOrder)
    const isBlurred = computed(() => getters['common/isBlurred'])

    const closeEverything = () => dispatch('common/closeEverything')

    watch(isBlurred, () => document.body.classList.toggle('fixed'))

    return {
      basketOpen,
      shownServiceExample,
      shownServiceOrder,
      isBlurred,
      closeEverything,
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
  position: fixed;
  z-index: 1;
  transition: background-color 0.3s ease-in-out;
  background-color: rgba($bg-color, 0.5);

  &--dark {
    background-color: rgba($bg-color, 0.95);
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

.modal-transition {
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
