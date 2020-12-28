<template>
  <section class="services">
    <PrevSectionButton
      :title="i18n.$t('defaults.news')"
      @click="$emit('switch-slide', 'news')"
    />
    <div class="services__content">
      <div class="services__heading container">
        <h2>{{i18n.$t('defaults.services')}}</h2>
        <router-link
          :to="servicesPath"
          class="link subtitle"
        >
          {{i18n.$t('defaults.allServices')}}
        </router-link>
      </div>
      <div class="services__list">
        <div class="services__list-scroll">{{i18n.$t('defaults.scroll')}}</div>
        <ServiceItem
          :key="service.id"
          :data="service"
          v-for="service in services.slice(0, 5)"
        />
      </div>
    </div>
  </section>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../../i18nPlugin'
import {ROUTE_CONF} from '../../router'
import PrevSectionButton from './PrevSectionButton'
import ServiceItem from '../Services/ServiceItem'

export default {
  name: 'Services',
  components: {ServiceItem, PrevSectionButton},
  setup() {
    const {state} = useStore()
    const i18n = useI18n()
    const services = computed(() => state.home.homeData.services)

    return {
      i18n,
      services,
      servicesPath: computed(() => ({
        name: ROUTE_CONF.SERVICES.name,
        params: {locale: i18n.locale.value},
      })),
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

    @include tablets() {
      padding: 0 40px;
      grid-template-columns: 412px;
      row-gap: 16px;
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
</style>