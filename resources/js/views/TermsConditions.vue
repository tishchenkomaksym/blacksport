<template>
  <PageLayout background-color="bgColor">
    <template v-slot:title>
      {{t('termsAndConditions')}}
    </template>
  </PageLayout>
</template>

<script>
import {watchEffect} from 'vue'
import {useI18n} from 'vue-i18n'

import PageLayout from '../components/Layout/PageLayout'

export default {
  name: 'TermsConditions',
  components: {PageLayout},
  setup() {
    const {t, locale} = useI18n()

    return {
      t,
    }
  },
}
</script>

<style scoped>

</style>