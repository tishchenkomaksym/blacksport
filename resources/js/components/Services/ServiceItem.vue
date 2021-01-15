<template>
  <article class="service-item">
    <div class="service-item__info">
      <h2>{{data.name}}</h2>
      <p class="service-item__info-description">{{data.description}}</p>
      <div class="service-item__info-order">
        <Button
          @click="$emit('open-order-modal', data.id, data.name)"
          link
        >
          {{i18n.$t('defaults.order')}}
        </Button>
      </div>

      <transition name="mobile-examples">
        <ServiceExamplesMobile
          :examples="data.examples"
          class="service-item__info-examples"
          v-if="isMobile && examplesShown"
        />
      </transition>
    </div>
    <p
      @click="examplesShown = !examplesShown"
      class="service-item__examples-button description"
    >
      <transition name="toggle-fade" mode="out-in">
        <span :key="examplesShown">
          {{i18n.$t(`defaults.${examplesShown ? 'hide' : 'serviceExamples'}`)}}
        </span>
      </transition>
    </p>
  </article>
</template>

<script>
import {computed, ref} from 'vue'
import {useI18n} from '../../i18nPlugin'
import useWindowSize from '../../hooks/useWindowSize'
import Button from '../Base/Button'
import ServiceExamples from './ServiceExamples'
import ServiceExamplesMobile from './ServiceExamplesMobile'

export default {
  name: 'ServiceItem',
  components: {ServiceExamplesMobile, ServiceExamples, Button},
  props: {
    data: Object,
  },
  setup() {
    const i18n = useI18n()
    const {width} = useWindowSize()
    const examplesShown = ref(false)
    const isMobile = computed(() => width.value <= 768)

    return {
      i18n,
      examplesShown,
      isMobile,
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.service-item {
  background-color: $sole;
  position: relative;
  display: flex;
  justify-content: space-between;

  &__info {
    flex-grow: 1;
    padding: 13px $spacing-md 13px $spacing;
    display: grid;
    grid-template-rows: auto 1fr auto;
    position: relative;
    overflow: hidden;

    @include tablets() {
      padding: $spacing $spacing-md $spacing $spacing;
    }

    h2 {
      margin: 0;
    }

    &-description {
      margin: $spacing-sm 0;
    }

    &-order {
      display: flex;
      justify-content: flex-end;
    }

    &-examples {
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      position: absolute;
      background-color: $sole;
      overflow-x: auto;
      overflow-y: hidden;
    }
  }

  &__examples-button {
    padding: $spacing 9px;
    top: 0;
    right: 0;
    cursor: pointer;
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    background-color: $silt;
    text-transform: uppercase;
    line-height: 14px;
    text-align: center;
  }
}

.mobile-examples {
  &-enter-active,
  &-leave-active {
    transition: all 0.5s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    transform: translateX(-100%);
    background-color: transparent;
  }
}

.toggle-fade {
  &-enter-active,
  &-leave-active {
    transition: opacity 0.25s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
  }
}
</style>