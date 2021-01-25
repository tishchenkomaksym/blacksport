import {onMounted, ref, nextTick} from 'vue'
import Glide from '@glidejs/glide'

/**
 * @description Use this hook to create a slider
 * @param glideRef {import('vue').Ref}
 * @param elementRef {import('vue').Ref<HTMLElement | null>}
 * @param options
 */
const useGlide = (glideRef, elementRef, options = {}) => {
  const transitionTimeout = ref(0)

  const mountGlide = () => {
    glideRef.value = new Glide(elementRef.value, options)
      .on('resize', refreshGlide)
      // Fix blinking anchors after swipe end
      .on('swipe.end', () => {
        clearTimeout(transitionTimeout.value)
        const links = elementRef.value.querySelectorAll('a')
        for (const link of links) link.classList.add('no-transition')
        transitionTimeout.value = setTimeout(() => {
          for (const link of links) link.classList.remove('no-transition')
        }, 1000)
      })
    glideRef.value.mount()
  }

  const destroyGlide = () => {
    if (glideRef.value) {
      glideRef.value.destroy()
      glideRef.value = null
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

  return {
    refreshGlide,
  }
}

export default useGlide
