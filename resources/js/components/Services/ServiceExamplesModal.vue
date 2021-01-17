<template>
  <Modal>
    <div class="service-examples-modal">
      <div class="glide service-examples-modal__slider" ref="examplesSlider">
        <div class="service-examples-modal__slider-controls" data-glide-el="controls" v-show="!isMobile">
          <button data-glide-dir="<">
            <svg width="14" height="24" viewBox="0 0 14 24" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M5.24537e-07 12C4.1758e-07 12.2803 0.117647 12.5477 0.324276 12.7372L12.3243 23.7372C12.7314 24.1104 13.364 24.0828 13.7372 23.6757C14.1103 23.2686 14.0828 22.636 13.6757 22.2629L2.47989 12L13.6757 1.73716C14.0828 1.36397 14.1103 0.7314 13.7372 0.324281C13.364 -0.0828383 12.7314 -0.110341 12.3243 0.262851L0.324276 11.2628C0.117647 11.4523 5.71889e-07 11.7197 5.24537e-07 12Z"/>
            </svg>
          </button>
          <button data-glide-dir=">">
            <svg width="14" height="24" viewBox="0 0 14 24" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14 12C14 12.2803 13.8824 12.5477 13.6757 12.7372L1.67572 23.7372C1.26861 24.1104 0.636039 24.0828 0.262846 23.6757C-0.110347 23.2686 -0.0828438 22.636 0.324275 22.2629L11.5201 12L0.324276 1.73716C-0.0828438 1.36397 -0.110347 0.7314 0.262846 0.324281C0.636038 -0.0828383 1.26861 -0.110341 1.67572 0.262851L13.6757 11.2628C13.8824 11.4523 14 11.7197 14 12Z"/>
            </svg>
          </button>
        </div>
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li
              :key="example.id"
              class="glide__slide"
              v-for="example in examples"
            >
              <ServiceExample :data="example"/>
            </li>
          </ul>
        </div>
        <div class="service-examples-modal__slider-navigation" data-glide-el="controls[nav]" v-show="!isMobile">
          <button
            :key="example.id"
            :class="{active: currentSlide === i}"
            :data-glide-dir="`=${i}`"
            v-for="(example, i) in examples"
          ></button>
        </div>
      </div>
    </div>
  </Modal>
</template>

<script>
import {computed, onMounted, onBeforeUnmount, ref} from 'vue'
import useWindowSize from '../../hooks/useWindowSize'
import useGlide from '../../hooks/useGlide'
import Modal from '../Base/Modal'
import ServiceExample from './ServiceExample'

export default {
  name: 'ServiceExamplesModal',
  components: {ServiceExample, Modal},
  props: {
    currentExample: {
      type: Number,
      required: true,
    },
    examples: {
      type: Array,
      required: true,
      default: [],
    },
  },
  setup({currentExample, examples}) {
    const {width} = useWindowSize()
    const isMobile = computed(() => width.value < 768)
    const glide = ref(null)
    const examplesSlider = ref(null)
    const currentSlide = ref(examples.findIndex(example => currentExample === example.id))
    const intervalRef = ref(0)

    useGlide(glide, examplesSlider, {
      startAt: currentSlide.value,
    })

    onMounted(() => {
      intervalRef.value = setInterval(() => {
        currentSlide.value = glide.value.index
      }, 250)
    })

    onBeforeUnmount(() => {
      clearInterval(intervalRef.value)
    })

    return {
      isMobile,
      currentSlide,
      examplesSlider,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.service-examples-modal {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: -57px;

  @include landscape() {
    height: initial;
    margin-top: initial;
  }

  @include tablets() {
    height: 100%;
    margin-top: initial;
  }

  &__slider {
    max-width: 600px;

    @include landscape() {
      max-width: 50vw;
    }

    @include tablets() {
      max-width: 600px;
      position: initial;
    }

    &-controls {
      max-width: 1440px;
      padding: 0 $spacing-lg;
      top: 50%;
      left: 0;
      right: 0;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      position: absolute;
      transform: translateY(-50%);

      svg {
        fill: $text-color;
        transition: fill 0.3s ease-in-out;

        &:hover {
          fill: $text-accent-color;
        }
      }
    }

    &-navigation {
      max-width: 1440px;
      padding: 0 $spacing-lg;
      display: flex;
      justify-content: center;
      position: absolute;
      left: 0;
      right: 0;
      margin: 0 auto;
      bottom: $spacing-lg;

      button {
        width: 8px;
        height: 8px;
        padding: 0;
        border-radius: 8px;
        border: 1px solid $text-color;
        transition: background-color 0.3s ease-in-out;

        &:not(:last-child) {
          margin-right: $spacing;
        }

        &.active {
          background-color: $text-color;
        }
      }
    }
  }
}
</style>