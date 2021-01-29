<template>
  <PageLayout
    :title="t('services')"
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
        <ScrollableContainer
          :key="JSON.stringify(examplesStyles)"
          :styles="examplesStyles"
          :class="{'services__examples-vertical': examplesPosition === 'vertical'}"
          :vertical="examplesPosition === 'vertical'"
          class="services__examples"
          v-if="examplesShown && !isMobile"
        >
          <template v-if="currentExamples.length">
            <div
              :key="example.id"
              :style="examplesPosition !== 'vertical' && `width: ${examplesStyles.height}`"
              v-for="example in currentExamples"
            >
              <ServiceExample
                :data="example"
                @click="showServiceExampleModal(example.id)"
              />
            </div>
          </template>
          <p v-else>{{t('noExamples')}}</p>
        </ScrollableContainer>
      </div>
      <p v-else>{{t('noServices')}}</p>
    </div>
    <ServiceOrderModal
      :service-id="selectedService.id"
      :service-name="selectedService.name"
      @close-modal="closeOrderModal"
      v-if="!!selectedService"
    />
    <ServiceExamplesModal
      :current-example="selectedExample"
      :examples="currentExamples"
      @close-modal="closeServiceExampleModal"
      v-if="!isMobile && selectedExample !== null"
    />
  </PageLayout>
</template>

<script>
import {computed, onBeforeUnmount, ref, watch, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import useWindowSize from '../hooks/useWindowSize'
import PageLayout from '../components/Layout/PageLayout'
import ServiceItem from '../components/Services/ServiceItem'
import ServiceOrderModal from '../components/Services/ServiceOrderModal'
import ScrollableContainer from '../components/Layout/ScrollableContainer'
import ServiceExample from '../components/Services/ServiceExample'
import ServiceExamplesModal from '../components/Services/ServiceExamplesModal'

export default {
  name: 'Services',
  components: {ServiceExamplesModal, ServiceExample, ScrollableContainer, ServiceOrderModal, ServiceItem, PageLayout},
  setup() {
    const {commit, dispatch, state} = useStore()
    const {width} = useWindowSize()
    const {t, locale} = useI18n()
    const services = computed(() => state.services.services)
    const selectedService = ref(null)

    const isMobile = computed(() => width.value < 768)
    const isLaptop = computed(() => width.value >= 768 && width.value < 1024)
    const isDesktop = computed(() => width.value >= 1024 && width.value < 1440)
    const isLarge = computed(() => width.value >= 1440)
    const servicesListRef = ref(null)
    const selectedExample = ref(null)
    const examplesShown = computed(() => state.services.examplesShown)
    const currentExamples = computed(() => {
      return services.value.find(service => service.id === examplesShown.value).examples
    })
    const examplesPosition = computed(() => {
      const serviceIndex = services.value.findIndex(service => service.id === examplesShown.value)
      if (isLaptop.value) {
        return serviceIndex % 2 === 0 ? 'right' : 'left'
      } else if (isDesktop.value || isLarge.value) {
        return serviceIndex % 3 === 0 ? 'right' : (serviceIndex + 2) % 3 === 0 ? 'vertical' : 'left'
      }
    })
    const examplesStyles = ref({})

    watchEffect(() => {
      dispatch('services/getServices', locale.value)
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

    const showServiceExampleModal = serviceId => {
      selectedExample.value = serviceId
    }

    const closeServiceExampleModal = () => {
      selectedExample.value = null
    }

    const calculateExamplesStyles = () => {
      if (isMobile.value || !examplesShown.value) return

      const element = servicesListRef.value.querySelector(`[data-id="${examplesShown.value}"]`)
      const elemWidth = element.offsetWidth
      const elemHeight = element.offsetHeight

      if (examplesPosition.value === 'right') {
        examplesStyles.value = {
          width: `${isLaptop.value ? elemWidth : isDesktop.value ? elemWidth * 2 + 24 : elemWidth * 2 + 62}px`,
          left: `${isLaptop.value || isDesktop.value ? elemWidth + 24 : elemWidth + 62}px`,
          height: `${elemHeight}px`,
          top: `${element.offsetTop}px`,
        }
      } else if (examplesPosition.value === 'left') {
        examplesStyles.value = {
          width: `${(isLaptop.value ? elemWidth : isDesktop.value ? elemWidth * 2 + 24 : elemWidth * 2 + 62) + 1}px`,
          left: 0,
          height: `${elemHeight}px`,
          top: `${element.offsetTop}px`,
        }
      } else if (examplesPosition.value === 'vertical') {
        const serviceIndex = services.value.findIndex(service => service.id === examplesShown.value)
        const rowBelowExists = !!services.value[serviceIndex + 2]
        const nextRowHeight = rowBelowExists ? servicesListRef.value.querySelector(`[data-id="${services.value[serviceIndex + 2].id}"]`).offsetHeight : 0
        examplesStyles.value = {
          width: `${elemWidth + 1}px`,
          right: 0,
          height: `${rowBelowExists ? elemHeight + nextRowHeight + 16 : elemHeight}px`,
          top: `${element.offsetTop}px`,
        }
      } else {
        examplesStyles.value = {}
      }
    }

    watch(examplesShown, () => calculateExamplesStyles())
    watch(width, () => calculateExamplesStyles())

    return {
      t,
      isMobile,
      services,
      servicesListRef,
      selectedService,
      openOrderModal,
      closeOrderModal,
      selectedExample,
      examplesPosition,
      currentExamples,
      examplesShown,
      examplesStyles,
      showServiceExampleModal,
      closeServiceExampleModal,
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
    overflow: hidden;
    position: relative;
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
      padding-top: $spacing-lg;
      height: 100%;
      box-sizing: border-box;
      overflow-y: auto;
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

      &-vertical {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: $spacing;
      }
    }
  }
}
</style>
