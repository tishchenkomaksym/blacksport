<template>
  <div
    :class="{'scrollable--active': isDragging, 'scrollable--vertical': vertical}"
    :data-dir="direction"
    :style="sliderStyles"
    @mousedown="handleMouseDown"
    @mouseup="handlerMouseUp"
    @mouseleave="handleMouseLeave"
    @mousemove="handleMouseMove"
    class="scrollable"
    ref="slider"
  >
    <slot />
  </div>
</template>

<script>
import {computed, ref} from 'vue'

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
  },
  setup(props) {
    /** @type import('vue').Ref<HTMLDivElement> */
    const slider = ref(null)
    const start = ref(0)
    const scrollValue = ref(0)
    const isDragging = ref(false)
    const velocity = ref(0)
    const momentumId = ref(null)

    const pageCoord = computed(() => props.vertical ? 'pageY' : 'pageX')
    const offsetPos = computed(() => props.vertical ? 'offsetTop' : 'offsetLeft')
    const scrollPos = computed(() => props.vertical ? 'scrollTop' : 'scrollLeft')

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
      toggleClickEvents(false)
      beginMomentumTracking()
    }

    const handleMouseLeave = () => {
      isDragging.value = false
      toggleClickEvents(false)
    }

    /**
     * @description Track speed when dragging the slider.
     * @param event {MouseEvent}
     * */
    const handleMouseMove = event => {
      if (!isDragging.value) return
      event.preventDefault()
      toggleClickEvents(true)
      const position = event[pageCoord.value] - slider.value[offsetPos.value]
      const walk = position - start.value
      const prevScroll = slider.value[scrollPos.value]
      slider.value[scrollPos.value] = scrollValue.value - walk
      velocity.value = slider.value[scrollPos.value] - prevScroll
    }

    const toggleClickEvents = disable => {
      for (const child of slider.value.childNodes) {
        if (child.nodeType === 3) continue
        child.style.pointerEvents = disable ? 'none' : ''
      }
    }

    const sliderStyles = computed(() => ({
      '--gap': `${props.gap / 2}px`,
      direction: props.direction,
    }))

    return {
      slider,
      isDragging,
      sliderStyles,
      handleMouseDown,
      handleMouseLeave,
      handlerMouseUp,
      handleMouseMove,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

.scrollable {
  --gap: $spacing-sm;
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
    vertical-align: middle;
    margin: 0 var(--gap);
  }
}
</style>