<template>
  <PageLayout background-color="bgColor">
    <template v-slot:title>
      {{t('refundPolicy')}}
    </template>
    <GradientContainer class="refund" color="bgColor">
      <h2>{{t('refundPolicy')}}</h2>
      <p
        :key="i"
        v-for="(paragraph, i) in paragraphs"
      >
        {{paragraph}}
      </p>
    </GradientContainer>
  </PageLayout>
</template>

<script>
import {computed, ref, watchEffect} from 'vue'
import {useI18n} from 'vue-i18n'
import useParseText from '../hooks/useParseText'
import commonApi from '../api/common'

import PageLayout from '../components/Layout/PageLayout'
import GradientContainer from '../components/Layout/GradientContainer'

export default {
  name: 'RefundPolicy',
  components: {GradientContainer, PageLayout},
  setup() {
    const {t, locale} = useI18n()
    const pageData = ref({})
    const paragraphs = computed(() => useParseText(pageData.value.meta_description || '').value)

    watchEffect(async () => {
      pageData.value = await commonApi.getRefundPolicy(locale.value)
    })

    return {
      t,
      paragraphs,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";
@import "../assets/scss/page-helpers";

.refund {
  @include tablets() {
    overflow-y: auto;
  }

  @include mobile-landscape() {
    height: calc(#{$page-height} + #{$spacing-lg});
  }

  @media screen and (min-width: 768px) and (min-height: 768px) {
    @include page-height;
  }
}
</style>
