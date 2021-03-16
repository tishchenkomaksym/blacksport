import {computed} from 'vue'

// TODO Remove placeholder for lorempixel
const getSrc = src => {
  if (src === null || src.startsWith('https://lorempixel.com/')) return '/img/placeholder-image.svg'
  return `${process.env.MIX_STORAGE_URL}/${encodeURI(src)}`
}

/**
 * @description Get array of image sources from JSON string
 * @param imagesSrc {string | string[]}
 * @param single {boolean}
 * @return {import('vue').ComputedRef<string[]>}
 */
const useImageStorage = (imagesSrc, single = false) => computed(() => {
  if (imagesSrc) {
    if (single) return getSrc(imagesSrc)
    return (typeof imagesSrc === 'string' ? JSON.parse(imagesSrc) : imagesSrc).map(src => getSrc(src))
  }
  // If images equal null
  return single ? '/img/placeholder-image.svg' : ['/img/placeholder-image.svg']
})

export default useImageStorage
