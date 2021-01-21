<template>
  <div
    :class="{'scrollable--active': isDragging, 'scrollable--vertical': vertical}"
    :data-dir="direction"
    :style="sliderStyles"
    class="scrollable"
    ref="slider"
  >
    <slot />
  </div>
</template>

<script>
import {computed, ref, onMounted, onBeforeUnmount} from 'vue'

export default {
  name: 'ScrollableContainer',
  props: {
    direction: {
      type: String,
      default: 'ltr',
    },
    gap: {
      type: Number,
      default: 8,
    },
    vertical: {
      type: Boolean,
      default: false,
    },
    styles: {
      type: Object,
      default: {},
    },
  },
  setup({direction, gap, styles, vertical}) {
    /** @type import('vue').Ref<HTMLDivElement> */
    const slider = ref(null)
    const start = ref(0)
    const scrollValue = ref(0)
    const isDragging = ref(false)
    const velocity = ref(0)
    const momentumId = ref(null)

    const pageCoord = computed(() => vertical ? 'pageY' : 'pageX')
    const offsetPos = computed(() => vertical ? 'offsetTop' : 'offsetLeft')
    const scrollPos = computed(() => vertical ? 'scrollTop' : 'scrollLeft')

    const cancelMomentumTracking = () => {
      cancelAnimationFrame(momentumId.value)
    }

    const momentumLoop = () => {
      slider.value[scrollPos.value] += velocity.value
      velocity.value *= 0.95
      if (Math.abs(velocity.value) > 0.5) momentumId.value = requestAnimationFrame(momentumLoop)
    }

    const beginMomentumTracking = () => {
      cancelMomentumTracking()
      momentumId.value = requestAnimationFrame(momentumLoop)
    }

    /** @param event {MouseEvent} */
    const handleMouseDown = event => {
      isDragging.value = true
      start.value = event[pageCoord.value] - slider.value[offsetPos.value]
      scrollValue.value = slider.value[scrollPos.value]
      cancelMomentumTracking()
    }

    const handlerMouseUp = () => {
      isDragging.value = false
      beginMomentumTracking()
    }

    const handleMouseLeave = () => {
      isDragging.value = false
    }

    /**
     * @description Track speed when dragging the slider.
     * @param event {MouseEvent}
     * */
    const handleMouseMove = event => {
      if (!isDragging.value) return
      event.preventDefault()
      const position = event[pageCoord.value] - slider.value[offsetPos.value]
      const walk = position - start.value
      const prevScroll = slider.value[scrollPos.value]
      slider.value[scrollPos.value] = scrollValue.value - walk
      velocity.value = slider.value[scrollPos.value] - prevScroll
    }

    onMounted(() => {
      slider.value.addEventListener('mousedown', handleMouseDown)
      slider.value.addEventListener('mouseleave', handleMouseLeave)
      slider.value.addEventListener('mouseup', handlerMouseUp)
      slider.value.addEventListener('mousemove', handleMouseMove)
    })

    onBeforeUnmount(() => {
      cancelMomentumTracking()
      slider.value.removeEventListener('mousedown', handleMouseDown)
      slider.value.removeEventListener('mouseleave', handleMouseLeave)
      slider.value.removeEventListener('mouseup', handlerMouseUp)
      slider.value.removeEventListener('mousemove', handleMouseMove)
    })

    const sliderStyles = computed(() => ({
      ...styles,
      '--gap': `${gap / 2}px`,
      direction,
    }))

    return {
      slider,
      isDragging,
      sliderStyles,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

.scrollable {
  --gap: 8px;
  white-space: nowrap;
  user-select: none;

  /* Hide scrollbar for Chrome, Safari and Opera */
  &::-webkit-scrollbar {
    display: none;
  }
  /* Hide scrollbar for IE, Edge and Firefox */
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */

  &--active {
    cursor: grabbing;
  }

  &:not(&--vertical) {
    overflow-x: auto;
    overflow-y: hidden;
  }

  &--vertical {
    overflow-x: hidden;
    overflow-y: auto;

    :deep(> *) {
      margin: var(--gap) 0;
    }
  }

  &[data-dir="rtl"]:not(&--vertical):deep(> *) {
    &:first-of-type {
      margin-right: 0;
    }

    &:last-of-type {
      margin-left: 0;
    }
  }

  &[data-dir="ltr"]:not(&--vertical):deep(> *) {
    &:first-of-type {
      margin-left: 0;
    }

    &:last-of-type {
      margin-right: 0;
    }
  }

  &:not(&--vertical):deep(> *) {
    display: inline-block;
    margin: 0 var(--gap);
  }
}
</style>