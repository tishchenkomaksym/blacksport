<template>
  <div
    :style="mobileExamplesStyles"
    class="service-examples-mobile"
  >
    <template v-if="examples.length">
      <ServiceExample
        :key="example.id"
        :data="example"
        v-for="example in examples"
      />
    </template>
    <p class="service-examples-mobile__empty-message" v-else>{{i18n.$t('defaults.noExamples')}}</p>
  </div>
</template>

<script>
import {computed} from 'vue'
import {useI18n} from '../../i18nPlugin'
import ServiceExample from './ServiceExample'

export default {
  name: 'ServiceExamplesMobile',
  components: {ServiceExample},
  props: {
    examples: {
      type: Array,
      default: [],
      required: true,
    },
  },
  setup({examples}) {
    const i18n = useI18n()
    const mobileExamplesStyles = computed(() => ({
      gridTemplateColumns: `repeat(${examples.length}, 50%)`
    }))

    return {
      i18n,
      mobileExamplesStyles,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

.service-examples-mobile {
  display: grid;
  column-gap: $spacing;
  align-items: center;
  direction: rtl;

  &__empty-message {
    padding: 0 $spacing;
  }
}
</style>