<template>
  <div
    @scroll="recalculateGradients"
    class="gradient-container"
    ref="gradientContainer"
  >
    <transition name="gradient-transition">
      <div
        :style="topGradientStyles"
        class="gradient-container__top-gradient"
        v-if="topGradientShown"
      />
    </transition>
    <slot />
    <transition name="gradient-transition">
      <div
        :style="bottomGradientStyles"
        class="gradient-container__bottom-gradient"
        v-if="bottomGradientShown"
      />
    </transition>
  </div>
</template>

<script>
import {computed, onMounted, onBeforeUnmount, nextTick, ref} from 'vue'
import { COLORS } from '../../store/modules/common'
import { hexToRgb } from '../../helpers'

export default {
  name: 'GradientContainer',
  props: {
    color: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    /** @type import('vue').Ref<HTMLDivElement> */
    const gradientContainer = ref(null)
    const resizeObserver = ref(null)
    const topGradientShown = ref(false)
    const rgb = computed(() => hexToRgb(COLORS[props.color]))
    const color = computed(() => `${rgb.value.r}, ${rgb.value.g}, ${rgb.value.b}`)
    const topGradientStyles = ref({
      background: `linear-gradient(180deg, rgb(${color.value}) 0%, rgba(${color.value}, 0) 100%)`,
    })
    const bottomGradientShown = ref(false)
    const bottomGradientStyles = ref({
      background: `linear-gradient(180deg, rgba(${color.value}, 0) 0%, rgb(${color.value}) 100%)`,
    })

    const recalculateGradients = async () => {
      const {offsetHeight, scrollTop, scrollHeight} = gradientContainer.value
      const {top, height, width} = gradientContainer.value.getBoundingClientRect()
      const isScrollable = scrollHeight - offsetHeight > 0
      topGradientStyles.value = {
        ...topGradientStyles.value,
        width: `${isScrollable ? width - 8 : width}px`,
        top: `${top}px`,
      }
      bottomGradientStyles.value = {
        ...bottomGradientStyles.value,
        width: `${isScrollable ? width - 8 : width}px`,
        top: `${top + height - 40}px`,
      }
      await nextTick() // Wait for HTML redraw
      topGradientShown.value = scrollTop !== 0
      bottomGradientShown.value = scrollHeight !== offsetHeight && (scrollHeight - scrollTop) !== offsetHeight
    }

    onMounted(() => {
      resizeObserver.value = new ResizeObserver(recalculateGradients)
      resizeObserver.value.observe(gradientContainer.value)
    })

    onBeforeUnmount(() => {
      resizeObserver.value.disconnect()
    })

    return {
      gradientContainer,
      topGradientShown,
      topGradientStyles,
      bottomGradientShown,
      bottomGradientStyles,
      recalculateGradients,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/page-helpers";
@import "../../assets/scss/variables";

.gradient-container {
  height: 100%;

  &__top-gradient,
  &__bottom-gradient {
    width: 100%;
    height: 40px;
    position: fixed;
    z-index: 1;
    pointer-events: none;
  }

  &__top-gradient {
    top: 0;
  }

  &__bottom-gradient {
    bottom: 0;
  }
}

.gradient-transition {
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
