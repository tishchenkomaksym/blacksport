<template>
  <section class="services">
    <PrevSectionButton
      :title="t('news')"
      @click="$emit('switch-slide', 'news')"
    />
    <div class="services__content">
      <div class="services__heading container">
        <h2>{{t('services')}}</h2>
        <router-link
          :to="servicesPath"
          class="link subtitle"
        >
          {{t('allServices')}}
        </router-link>
      </div>
      <div class="services__list">
        <div class="services__list-scroll">{{t('scroll')}}</div>
        <div
          :key="service.id"
          class="services__list-item"
          v-for="service in services.slice(0, 5)"
        >
          <ServiceItem
            :data="service"
            :examples-shown="examplesShownId === service.id"
            @on-toggle-examples="onToggleExamples"
          />
          <transition name="service-examples-transition">
            <ScrollableContainer
              class="services__list-examples"
              v-if="!isMobile && examplesShownId === service.id"
            >
              <template v-if="currentExamples.length">
                <div :key="example.id" style="width: 192px" v-for="example in currentExamples">
                  <ServiceExample
                    :data="example"
                    @click="showServiceExampleModal(example.id)"
                  />
                </div>
              </template>
              <p v-else>{{t('noExamples')}}</p>
            </ScrollableContainer>
          </transition>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {computed, ref} from 'vue'
import {useStore} from 'vuex'
import useWindowSize from '../../hooks/useWindowSize'
import {useI18n} from 'vue-i18n'
import {ROUTE_CONF} from '../../router'

import PrevSectionButton from './PrevSectionButton'
import ServiceItem from '../Services/ServiceItem'
import ServiceExamplesModal from '../Services/ServiceExamplesModal'
import ScrollableContainer from '../Layout/ScrollableContainer'
import ServiceExample from '../Services/ServiceExample'

export default {
  name: 'Services',
  components: {ServiceExample, ScrollableContainer, ServiceExamplesModal, ServiceItem, PrevSectionButton},
  setup() {
    const {commit, state} = useStore()
    const {t, locale} = useI18n()
    const {width} = useWindowSize()
    const isMobile = computed(() => width.value < 768)
    const services = computed(() => state.home.homeData.services)
    const examplesShownId = ref(null)
    const currentExamples = computed(() => services.value.find(({id}) => id === examplesShownId.value).examples)

    const onToggleExamples = (id, examplesShown) => {
      examplesShownId.value = examplesShown ? id : null
    }

    const showServiceExampleModal = serviceId => {
      commit('common/setShownServiceExample', {
        example: serviceId,
        examples: services.value.find(service => service.id === examplesShownId.value).examples,
      })
    }

    return {
      t,
      isMobile,
      services,
      servicesPath: computed(() => ({
        name: ROUTE_CONF.SERVICES.name,
        params: {locale: locale.value},
      })),
      onToggleExamples,
      examplesShownId,
      currentExamples,
      showServiceExampleModal,
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.services {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;

  &__content {
    margin-top: 16px;
    height: 77vh;
    background-color: $smoke;
    box-sizing: border-box;
    position: relative;

    @include landscape() {
      margin-top: 8px;
      height: 65vh;
      overflow: hidden;
    }

    @include laptop() {
      margin-top: 40px;
      height: 84vh;
    }
  }

  &__heading {
    display: flex;
    align-items: center;
    justify-content: space-between;

    @include tablets() {
      padding: 0 40px;
    }

    @include laptop() {
      padding: 40px 40px 0;
    }

    @include desktop() {
      width: 100%;
      position: absolute;
      z-index: 1;
      margin: 0 auto;
      left: 0;
      right: 0;
    }

    h2 {
      @include laptop() {
        margin: 0 0 16px;
        font-size: 36px;
        font-weight: 700;
      }

      @include desktop() {
        margin: 0;
      }
    }
  }

  &__list {
    height: calc(77vh - 56px);
    overflow-y: auto;
    padding: 0 16px;
    display: grid;
    row-gap: 8px;
    box-sizing: border-box;
    position: relative;

    /* Hide scrollbar for IE, Edge and Firefox */
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    /* Hide scrollbar for Chrome, Safari and Opera */
    &::-webkit-scrollbar {
      display: none;
    }

    &::after {
      content: '';
      display: block;
      height: 36px;
      width: 100%;
    }

    @include landscape() {
      overflow-y: initial;
    }

    @include tablets() {
      padding: 0 40px;
      grid-auto-rows: 192px;
      row-gap: 16px;
      overflow-y: auto;
    }

    @include laptop() {
      height: calc(77vh - 33px);
      max-width: 1440px;
      padding: 0 0 0 153px;
      margin: 0 auto;
    }

    @include desktop() {
      height: 100%;
      padding: 40px 0 0 273px;
    }

    &-item {
      @include tablets() {
        display: grid;
        grid-template-columns: 412px 1fr;
      }
    }

    &-examples {
      @include tablets() {
        padding-left: $spacing-md;
      }

      @include desktop() {
        padding-left: 86px;
      }
    }

    &-scroll {
      display: none;

      @include laptop() {
        display: initial;
        top: 40px;
        left: 248px;
        position: absolute;
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        font-weight: 300;
        font-size: 12px;
        text-transform: uppercase;
      }
    }
  }
}

.service-examples-transition {
  &-enter-active,
  &-leave-active {
    transition: transform 0.75s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    transform: translateX(100%);
  }
}
</style>
