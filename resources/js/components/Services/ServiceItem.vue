<template>
  <article class="service-item" :data-id="data.id">
    <div class="service-item__info">
      <h2>{{data.name}}</h2>
      <p class="service-item__info-description">{{description}}</p>
      <div class="service-item__info-order">
        <Button @click="openOrderModal" link>
          {{t('order')}}
        </Button>
      </div>

      <transition name="mobile-examples">
        <ScrollableContainer
          :gap="16"
          class="service-item__info-examples"
          ref="mobileSlider"
          direction="rtl"
          v-if="isMobile && examplesShown"
        >
          <div
            :key="example.id"
            :style="{width: `${mobileExampleWidth}px`}"
            v-for="example in data.examples"
          >
            <ServiceExample
              :data="example"
              @click="showServiceExampleModal(example.id)"
            />
          </div>
        </ScrollableContainer>
      </transition>
    </div>
    <p
      @click="toggleExamples"
      class="service-item__examples-button description"
    >
      <transition name="toggle-fade" mode="out-in">
        <span :key="examplesShown">
          {{t(examplesShown ? 'hide' : 'serviceExamples')}}
        </span>
      </transition>
    </p>
  </article>
</template>

<script>
import {computed, nextTick, ref, watch} from 'vue'
import {useI18n} from 'vue-i18n'
import {useStore} from 'vuex'
import useWindowSize from '../../hooks/useWindowSize'
import useTruncate from '../../hooks/useTruncate'

import Button from '../Base/Button'
import ServiceExamplesModal from './ServiceExamplesModal'
import ScrollableContainer from '../Layout/ScrollableContainer'
import ServiceExample from './ServiceExample'

export default {
  name: 'ServiceItem',
  components: {ServiceExample, ScrollableContainer, ServiceExamplesModal, Button},
  props: {
    data: {
      type: Object,
      required: true,
    },
    examplesShown: {
      type: Boolean,
      default: false,
    },
  },
  emits: [
    'on-toggle-examples',
  ],
  setup(props, {emit}) {
    const {t} = useI18n()
    const {commit} = useStore()
    const {width} = useWindowSize()
    const isMobile = computed(() => width.value < 768)

    const description = useTruncate(props.data.description, 150)
    const selectedExample = ref(null)

    const mobileSlider = ref(null)
    const mobileExampleWidth = ref(0)

    const toggleExamples = () => emit('on-toggle-examples', props.data.id, !props.examplesShown)
    const showServiceExampleModal = serviceId => {
      commit('common/setShownServiceExample', {
        example: serviceId,
        examples: props.data.examples,
      })
    }
    const openOrderModal = () => {
      commit('common/setShownServiceOrder', {id: props.data.id, name: props.data.name})
    }

    // Make width the same as height to keep examples square
    watch(width, async () => {
      if (width.value >= 768) return
      await nextTick()
      if (props.examplesShown.value && mobileSlider.value) mobileExampleWidth.value = mobileSlider.value.slider.offsetHeight
    })
    watch(() => props.examplesShown, async examplesShown => {
      if (width.value >= 768) return
      await nextTick()
      if (examplesShown) mobileExampleWidth.value = mobileSlider.value.slider.offsetHeight
    })

    return {
      t,
      isMobile,
      selectedExample,
      description,
      mobileSlider,
      mobileExampleWidth,
      toggleExamples,
      showServiceExampleModal,
      openOrderModal,
    }
  },
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
