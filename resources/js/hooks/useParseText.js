import {computed} from 'vue'

const useParseText = text => {
  return computed(() => text.split('\n').filter(item => !!item.trim()))
}

export default useParseText
