<template>
  <PageLayout
    background-color="smoke"
  >
    <template v-slot:title>
      {{t('services')}}
    </template>
    <GradientContainer
      class="services"
      color="smoke"
      ref="servicesListRef"
      v-if="services.length"
    >
      <ServiceItem
        :data="service"
        :examples-shown="examplesShownId === service.id"
        :key="service.id"
        @on-toggle-examples="onToggleExamples"
        @on-open-order-modal="onOpenOrderModal"
        v-for="service in services"
      />
      <transition name="service-examples-transition">
        <div
          :key="JSON.stringify(examplesStyles)"
          :style="examplesStyles"
          class="services__examples-container"
          v-if="examplesShownId !== null && !isMobile"
        >
          <ScrollableContainer
            :class="{'services__examples--vertical': examplesPosition === 'vertical', 'services__examples--left': examplesPosition === 'left'}"
            :vertical="examplesPosition === 'vertical'"
            class="services__examples"
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
      </transition>
    </GradientContainer>
    <p v-else>{{t('noServices')}}</p>
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
import {computed, ref, watch, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import useWindowSize from '../hooks/useWindowSize'
import PageLayout from '../components/Layout/PageLayout'
import ServiceItem from '../components/Services/ServiceItem'
import ServiceOrderModal from '../components/Services/ServiceOrderModal'
import ScrollableContainer from '../components/Layout/ScrollableContainer'
import ServiceExample from '../components/Services/ServiceExample'
import ServiceExamplesModal from '../components/Services/ServiceExamplesModal'
import GradientContainer from '../components/Layout/GradientContainer'

export default {
  name: 'Services',
  components: {
    GradientContainer,
    ServiceExamplesModal, ServiceExample, ScrollableContainer, ServiceOrderModal, ServiceItem, PageLayout,
  },
  setup() {
    const {dispatch, state} = useStore()
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
    const examplesShownId = ref(null)
    const currentExamples = computed(() => {
      return services.value.find(service => service.id === examplesShownId.value).examples
    })
    const examplesPosition = computed(() => {
      const serviceIndex = services.value.findIndex(service => service.id === examplesShownId.value)
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

    const onToggleExamples = (id, examplesShown) => {
      examplesShownId.value = examplesShown ? id : null
    }

    const onOpenOrderModal = (serviceId, serviceName) => {
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
      if (isMobile.value || examplesShownId.value === null) return

      const element = servicesListRef.value.$el.querySelector(`[data-id="${examplesShownId.value}"]`)
      const elemWidth = element.offsetWidth
      const elemHeight = element.offsetHeight

      if (examplesPosition.value === 'right') {
        examplesStyles.value = {
          width: `${isLaptop.value ? elemWidth : isDesktop.value ? elemWidth * 2 + 24 : elemWidth * 2 + 62}px`,
          left: `${isLaptop.value || isDesktop.value ? elemWidth + 24 : elemWidth + 62}px`,
          height: `${elemHeight + 1}px`,
          top: `${element.offsetTop}px`,
        }
      } else if (examplesPosition.value === 'left') {
        examplesStyles.value = {
          width: `${(isLaptop.value ? elemWidth : isDesktop.value ? elemWidth * 2 + 24 : elemWidth * 2 + 62) + 1}px`,
          left: 0,
          height: `${elemHeight + 1}px`,
          top: `${element.offsetTop}px`,
        }
      } else if (examplesPosition.value === 'vertical') {
        const serviceIndex = services.value.findIndex(service => service.id === examplesShownId.value)
        const rowBelowExists = !!services.value[serviceIndex + 2]
        const nextRowHeight = rowBelowExists ? servicesListRef.value.$el.querySelector(`[data-id="${services.value[serviceIndex + 2].id}"]`).offsetHeight : 0
        examplesStyles.value = {
          width: `${elemWidth + 1}px`,
          right: 0,
          height: `${rowBelowExists && currentExamples.value.length > 2 ? elemHeight + nextRowHeight + 17 : elemHeight + 1}px`,
          top: `${element.offsetTop}px`,
        }
      } else {
        examplesStyles.value = {}
      }
    }

    watch(examplesShownId, () => calculateExamplesStyles())
    watch(width, () => calculateExamplesStyles())

    return {
      t,
      isMobile,
      services,
      servicesListRef,
      selectedService,
      onOpenOrderModal,
      closeOrderModal,
      selectedExample,
      examplesPosition,
      currentExamples,
      onToggleExamples,
      examplesShownId,
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
  @include tablets() {
    overflow: hidden;
    position: relative;
  }

  @include mobile-landscape() {
    height: calc(#{$page-height} - 49px);
  }

  @media screen and (min-width: 768px) and (min-height: 768px) {
    @include page-height;
  }

  display: grid;
  row-gap: $spacing-sm;
  position: relative;

  @include phones() {
    grid-template-columns: repeat(2, 1fr);
    row-gap: $spacing;
    column-gap: $spacing-md;
  }

  @include tablets() {
    overflow-x: hidden;
  }

  @include laptop() {
    box-sizing: border-box;
    overflow-y: auto;
    grid-template-columns: repeat(3, 1fr);
  }

  @include large-desktop() {
    column-gap: 62px;
  }

  &__examples {
    @include tablets() {
      &-container {
        position: absolute;
        z-index: 1;
        background-color: $smoke;
      }

      &--vertical {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: $spacing;
      }
    }
  }
}

.service-examples-transition {
  &-enter-active,
  &-leave-active {
    transition: background-color 0.75s ease-in-out;

    .services__examples {
      transition: transform 0.75s ease-in-out;
    }
  }

  &-enter-from,
  &-leave-to {
    background-color: transparent;

    .services__examples:not(.services__examples--left) {
      transform: translateX(100%);
    }

    .services__examples--left {
      transform: translateX(-100%);
    }
  }
}
</style>
