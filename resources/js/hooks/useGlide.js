import {onMounted, nextTick} from 'vue'
import Glide from '@glidejs/glide'

/**
 * @description Use this hook to create a slider
 * @param glideRef {import('vue').Ref}
 * @param elementRef {import('vue').Ref<HTMLElement | null>}
 * @param options
 */
const useGlide = (glideRef, elementRef, options) => {
  const mountGlide = () => {
    glideRef.value = new Glide(elementRef.value, options)
      .on('resize', refreshGlide)
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
}

export default useGlide
