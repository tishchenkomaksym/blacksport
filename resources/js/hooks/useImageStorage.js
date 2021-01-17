import {computed} from 'vue'

// TODO Remove placeholder for lorempixel
const getSrc = src => src.includes('lorempixel') ? '/img/placeholder-image.svg' : `${process.env.MIX_STORAGE_URL}/${src}`

/**
 * @description Get array of image sources from JSON string
 * @param imagesSrc {string}
 * @param single {boolean}
 * @return {import('vue').ComputedRef<string[]>}
 */
const useImageStorage = (imagesSrc, single = false) => computed(() => {
  if (imagesSrc) single ? getSrc(imagesSrc) : JSON.parse(imagesSrc).map(src => getSrc(src))
  // If images equal null
  return single ? '/img/placeholder-image.svg' : ['/img/placeholder-image.svg']
})

export default useImageStorage
