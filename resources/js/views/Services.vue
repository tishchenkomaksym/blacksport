<template>
  <PageLayout
    :title="i18n.$t('defaults.services')"
    background-color="smoke"
  >
    <div class="services">
      <div class="services__list" ref="servicesListRef" v-if="services.length">
        <ServiceItem
          :data="service"
          :key="service.id"
          @open-order-modal="openOrderModal"
          v-for="service in services"
        />
        <!-- TODO vertical container for the middle row -->
        <ScrollableContainer
          :key="examplesShown"
          :styles="examplesStyles()"
          class="services__examples"
          v-if="examplesShown && !isMobile"
        >
          <template v-if="services.find(service => service.id === examplesShown).examples.length">
            <div
              :key="example.id"
              :style="`width: ${examplesStyles().height}`"
              v-for="example in services.find(service => service.id === examplesShown).examples"
            >
              <ServiceExample
                :data="example"
              />
            </div>
          </template>
          <p v-else>{{i18n.$t('defaults.noExamples')}}</p>
        </ScrollableContainer>
      </div>
      <p v-else>{{i18n.$t('defaults.noServices')}}</p>

      <div class="services__end" />
    </div>
    <ServiceOrderModal
      :service-id="selectedService.id"
      :service-name="selectedService.name"
      @close-modal="closeOrderModal"
      v-if="!!selectedService"
    />
  </PageLayout>
</template>

<script>
import {computed, onBeforeUnmount, ref, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import useWindowSize from '../hooks/useWindowSize'
import PageLayout from '../components/Layout/PageLayout'
import ServiceItem from '../components/Services/ServiceItem'
import ServiceOrderModal from '../components/Services/ServiceOrderModal'
import ScrollableContainer from '../components/Layout/ScrollableContainer'
import ServiceExample from '../components/Services/ServiceExample'

export default {
  name: 'Services',
  components: {ServiceExample, ScrollableContainer, ServiceOrderModal, ServiceItem, PageLayout},
  setup() {
    const {commit, dispatch, state} = useStore()
    const {width} = useWindowSize()
    const i18n = useI18n()
    const services = computed(() => state.services.services)
    const selectedService = ref(null)

    const isMobile = computed(() => width.value < 768)
    const isLaptop = computed(() => width.value >= 768 && width.value < 1024)
    const isDesktop = computed(() => width.value >= 1024 && width.value < 1440)
    const isLarge = computed(() => width.value >= 1440)
    const servicesListRef = ref(null)
    const examplesShown = computed(() => state.services.examplesShown)
    const examplesPosition = computed(() => {
      const serviceIndex = services.value.findIndex(service => service.id === examplesShown.value)
      if (isLaptop.value) {
        return serviceIndex % 2 === 0 ? 'right' : 'left'
      } else if (isDesktop.value || isLarge.value) {
        return serviceIndex % 3 === 0 ? 'right' : (serviceIndex + 2) % 3 === 0 ? 'vertical' : 'left'
      }
    })

    watchEffect(() => {
      dispatch('services/getServices', i18n.locale.value)
    })

    onBeforeUnmount(() => {
      commit('services/setExamplesShown', null)
    })

    const openOrderModal = (serviceId, serviceName) => {
      selectedService.value = {id: serviceId, name: serviceName}
    }

    const closeOrderModal = () => {
      selectedService.value = null
    }

    // TODO responsiveness
    const examplesStyles = () => {
      if (width.value < 768) return {}
      const element = servicesListRef.value.querySelector(`[data-id="${examplesShown.value}"]`)
      const elemWidth = element.offsetWidth
      const elemHeight = element.offsetHeight
      console.log(examplesPosition.value)

      if (examplesPosition.value === 'right') {
        return {
          width: `${isLaptop.value ? elemWidth : isDesktop.value ? elemWidth * 2 + 24 : elemWidth * 2 + 62}px`,
          left: `${isLaptop.value || isDesktop.value ? elemWidth + 24 : elemWidth + 62}px`,
          height: `${elemHeight}px`,
          top: `${element.offsetTop}px`,
        }
      } else if (examplesPosition.value === 'left') {
        return {
          width: `${(isLaptop.value ? elemWidth : isDesktop.value ? elemWidth * 2 + 24 : elemWidth * 2 + 62) + 1}px`,
          left: 0,
          height: `${elemHeight}px`,
          top: `${element.offsetTop}px`,
        }
      } else if (examplesPosition.value === 'vertical') {
        // TODO check height of the row below
        const rowBelowExists = true
        return {
          width: `${elemWidth + 1}px`,
          right: 0,
          height: `${rowBelowExists ? elemHeight * 2 + 16 : elemHeight}px`,
          top: `${element.offsetTop}px`,
        }
      } else {
        return {}
      }
    }

    return {
      i18n,
      isMobile,
      services,
      servicesListRef,
      selectedService,
      openOrderModal,
      closeOrderModal,
      examplesShown,
      examplesStyles,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/page-helpers";
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";

.services {
  @include laptop() {
    margin-top: -$spacing-lg;
    padding-right: $spacing-sm;
    padding-top: $spacing-lg;
    overflow-y: auto;
    overflow-x: hidden;
    @include page-height;
    @include container-gradients($smoke);
  }

  &__list {
    display: grid;
    row-gap: $spacing-sm;
    position: relative;

    @include phones() {
      grid-template-columns: repeat(2, 1fr);
      row-gap: $spacing;
      column-gap: $spacing-md;
    }

    @include laptop() {
      grid-template-columns: repeat(3, 1fr);
    }

    @include large-desktop() {
      column-gap: 62px;
    }
  }

  &__examples {
    @include tablets() {
      position: absolute;
      z-index: 1;
      background-color: $smoke;
    }
  }

  @include laptop() {
    &__end {
      height: $gradient-height;
    }
  }
}
</style>
