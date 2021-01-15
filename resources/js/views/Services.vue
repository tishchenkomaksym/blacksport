<template>
  <PageLayout
    :title="i18n.$t('defaults.services')"
    background-color="smoke"
  >
    <div class="services">
      <div class="services__list" v-if="services.length">
        <ServiceItem
          :data="service"
          :key="service.id"
          @open-order-modal="openOrderModal"
          v-for="service in services"
        />
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
import {computed, ref, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'
import ServiceItem from '../components/Services/ServiceItem'
import ServiceOrderModal from '../components/Services/ServiceOrderModal'

export default {
  name: 'Services',
  components: {ServiceOrderModal, ServiceItem, PageLayout},
  setup() {
    const {dispatch, state} = useStore()
    const i18n = useI18n()
    const services = computed(() => state.services.services)
    const selectedService = ref(null)

    watchEffect(() => {
      dispatch('services/getServices', i18n.locale.value)
    })

    const openOrderModal = (serviceId, serviceName) => {
      selectedService.value = {id: serviceId, name: serviceName}
    }

    const closeOrderModal = () => {
      selectedService.value = null
    }

    return {
      i18n,
      services,
      selectedService,
      openOrderModal,
      closeOrderModal,
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
    @include page-height;
    @include container-gradients($smoke);
  }

  &__list {
    display: grid;
    row-gap: $spacing-sm;

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

  @include laptop() {
    &__end {
      height: $gradient-height;
    }
  }
}
</style>
