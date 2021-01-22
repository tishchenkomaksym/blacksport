import {computed} from 'vue'

const ellipsis = '...'

/**
 * @param string {string}
 * @param length {number}
 * @return {import('vue').ComputedRef<string>}
 */
const useTruncate = (string, length = 30) => {
  return computed(() => {
    if (string.length > length) {
      return string.substring(0, length - ellipsis.length) + ellipsis
    }
    return string
  })
}

export default useTruncate
