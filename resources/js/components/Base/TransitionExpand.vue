<template>
  <transition
    enter-active-class="enter-active"
    leave-active-class="leave-active"
    @before-enter="beforeEnter"
    @enter="enter"
    @after-enter="afterEnter"
    @before-leave="beforeLeave"
    @leave="leave"
    @after-leave="afterLeave"
  >
    <slot/>
  </transition>

</template>

<script>
export default {
  name: 'TransitionExpand',
  methods: {
    /** @param {HTMLElement} element */
    beforeEnter(element) {
      requestAnimationFrame(() => {
        if (!element.style.height) {
          element.style.height = '0px'
        }
        element.style.removeProperty('display')
      })
    },
    /** @param {HTMLElement} element */
    enter(element) {
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          element.style.height = `${element.scrollHeight}px`
        })
      })
    },
    /** @param {HTMLElement} element */
    afterEnter(element) {
      element.style.removeProperty('height')
    },
    /** @param {HTMLElement} element */
    beforeLeave(element) {
      requestAnimationFrame(() => {
        if (!element.style.height) {
          element.style.height = `${element.offsetHeight}px`
        }
      })
    },
    /** @param {HTMLElement} element */
    leave(element) {
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          element.style.height = '0px'
        })
      })
    },
    /** @param {HTMLElement} element */
    afterLeave(element) {
      element.style.removeProperty('height')
    },
  },
}
</script>

<style scoped lang="scss">
.enter-active,
.leave-active {
  overflow: hidden;
  transition: height 0.3s ease-in-out;
}
</style>
