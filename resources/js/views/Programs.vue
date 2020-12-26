<template>
  <PageLayout
    :title="i18n.$t('defaults.programs')"
    background-color="sole"
  >

  </PageLayout>
</template>

<script>
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'

export default {
  name: 'Programs',
  components: {PageLayout},
  setup() {
    const i18n = useI18n()

    return {
      i18n,
    }
  },
}
</script>
