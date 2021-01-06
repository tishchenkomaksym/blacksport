<template>
  <PageLayout
    :title="i18n.$t('defaults.services')"
    background-color="smoke"
  >
    <div class="services">
      <ServiceItem
        :data="service"
        :key="service.id"
        v-for="service in services"
      />
    </div>
  </PageLayout>
</template>

<script>
import {computed, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'
import ServiceItem from '../components/Services/ServiceItem'

export default {
  name: 'Services',
  components: {ServiceItem, PageLayout},
  setup() {
    const {dispatch, state} = useStore()
    const i18n = useI18n()
    const services = computed(() => state.pages.services)

    watchEffect(() => {
      dispatch('pages/getServices', i18n.locale.value)
    })

    return {
      i18n,
      services,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";

.services {
  display: grid;
  row-gap: 8px;

  @include tablets() {
    grid-template-columns: repeat(2, 1fr);
    row-gap: 16px;
    column-gap: 24px;
  }

  @include laptop() {
    grid-template-columns: repeat(3, 1fr);
    max-height: calc((640 * 100vh) / 900);
    overflow-y: auto;

    &::before, &::after {
      width: calc(100% - 88px);
      max-width: calc(1440px - 88px);
      height: 40px;
      content: '';
      display: block;
      position: absolute;
      z-index: 1;
    }

    &::before {
      top: 146px;
      background: linear-gradient(180deg, $smoke 0%, rgba(38, 38, 38, 0) 100%);
    }

    &::after {
      top: calc(106px + (640 * 100vh) / 900);
      background: linear-gradient(180deg, rgba(38, 38, 38, 0) 0%, $smoke 100%);
    }
  }

  @include large-desktop() {
    column-gap: 62px;
  }
}
</style>
