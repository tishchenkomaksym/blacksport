<template>
  <div class="test">I'm an example component</div>
  <div>{{i18n.$t('hello_world')}}</div>
  <button @click="switchLanguage">Switch language</button>
</template>

<script>
import {useI18n} from '../i18nPlugin'

export default {
  name: 'ExampleComponent',
  setup() {
    const i18n = useI18n()

    const switchLanguage = () => {
      const locale = i18n.locale.value === 'en' ? 'ru' : 'en'
      i18n.locale.value = locale
    }

    return {
      i18n,
      switchLanguage,
    }
  },
}
</script>

<style lang="scss">
.test {
  color: red;
}
</style>
