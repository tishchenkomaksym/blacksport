<template>
  <div class="modal">
    <div class="modal__close container">
      <Button
        @click="$emit('close-modal')"
        link
      >
        {{i18n.$t('defaults.close')}}

        <svg class="modal__close-icon" viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M1.70714 0.292893C1.31661 -0.0976311 0.68345 -0.0976311 0.292925 0.292893C-0.097599 0.683418 -0.097599 1.31658 0.292925 1.70711L8.0858 9.49998L0.292893 17.2929C-0.0976311 17.6834 -0.0976311 18.3166 0.292893 18.7071C0.683418 19.0976 1.31658 19.0976 1.70711 18.7071L9.50002 10.9142L14.4351 15.8492C14.8256 16.2398 15.4587 16.2398 15.8493 15.8492C16.2398 15.4587 16.2398 14.8256 15.8493 14.435L10.9142 9.49998L18.6777 1.73655C19.0682 1.34602 19.0682 0.712857 18.6777 0.322333C18.2871 -0.0681915 17.654 -0.0681925 17.2635 0.322333L9.50002 8.08577L1.70714 0.292893Z"
          />
        </svg>
      </Button>
    </div>
    <div class="modal__container container">
      <slot/>
    </div>
  </div>
</template>

<script>
import {useI18n} from '../../i18nPlugin'
import useWindowSize from '../../hooks/useWindowSize'
import Button from './Button'

export default {
  name: 'Modal',
  components: {Button},
  setup() {
    const i18n = useI18n()
    const {width} = useWindowSize()

    return {
      i18n,
      width,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.modal {
  width: 100vw;
  height: 100vh;
  top: 0;
  left: 0;
  position: fixed;
  backdrop-filter: blur(16px);
  background-color: rgba(white, 0.01);
  z-index: 1;
  overflow: auto;

  @include tablets() {
    display: flex;
    flex-direction: column;
  }

  &__close {
    padding: 20px 16px;
    display: flex;
    justify-content: flex-end;
    align-items: center;

    @include tablets() {
      width: 100%;
      padding: 48px 40px;
      margin: 0 auto;
      left: 0;
      right: 0;
      position: absolute;
      box-sizing: border-box;
    }

    &-icon {
      width: 11px;
      height: 11px;
      margin-left: 15px;
      fill: $text-color;

      @include tablets() {
        width: 17px;
        height: 17px;
        margin-left: 20px;
        transform: translateY(-2px);
      }
    }
  }

  &__container {
    padding: 0 16px;

    @include tablets() {
      padding: 116px 40px 90px;
      flex-grow: 1;
    }
  }
}
</style>