<template>
  <button class="basket">
    <svg width="24" height="22" viewBox="0 0 24 22" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M0.167934 0.445284C0.474286 -0.0142447 1.09516 -0.138418 1.55468 0.167934L4.10938 1.87107C4.65601 2.23549 4.98818 2.84461 4.99968 3.49998H21C22.6568 3.49998 24 4.84313 24 6.49998V7.22677C24 7.97307 23.7218 8.69257 23.2198 9.24479L19.3351 13.518C18.7665 14.1434 17.9605 14.5 17.1152 14.5H4.99998V16.1707C5.8524 16.472 6.52799 17.1476 6.82928 18H12.6707C13.0825 16.8348 14.1938 16 15.5 16C17.1568 16 18.5 17.3431 18.5 19C18.5 20.6568 17.1568 22 15.5 22C14.1938 22 13.0825 21.1652 12.6707 20H6.82928C6.41744 21.1652 5.3062 22 3.99998 22C2.34313 22 0.999984 20.6568 0.999984 19C0.999984 17.6938 1.83479 16.5825 2.99998 16.1707V14.5C2.99998 13.3954 3.89542 12.5 4.99998 12.5H17.1152C17.397 12.5 17.6657 12.3811 17.8552 12.1727L21.7399 7.89944C21.9073 7.71537 22 7.47554 22 7.22677V6.49998C22 5.9477 21.5523 5.49998 21 5.49998H4.99998V7.99998H14.5C15.0523 7.99998 15.5 8.4477 15.5 8.99998C15.5 9.55227 15.0523 9.99998 14.5 9.99998H4.99998C3.89541 9.99998 2.99998 9.10455 2.99998 7.99998V3.53517L0.445284 1.83203C-0.0142447 1.52568 -0.138418 0.904813 0.167934 0.445284ZM3.99998 18C3.4477 18 2.99998 18.4477 2.99998 19C2.99998 19.5523 3.4477 20 3.99998 20C4.55227 20 4.99998 19.5523 4.99998 19C4.99998 18.4477 4.55227 18 3.99998 18ZM15.5 18C14.9477 18 14.5 18.4477 14.5 19C14.5 19.5523 14.9477 20 15.5 20C16.0523 20 16.5 19.5523 16.5 19C16.5 18.4477 16.0523 18 15.5 18Z"/>
    </svg>
    <span class="basket__count" v-if="productNumber > 0">{{productNumber}}</span>
  </button>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'

export default {
  name: 'BasketIcon',
  setup() {
    const {getters} = useStore()
    const productNumber = computed(() => getters['products/productNumber'])

    return {
      productNumber,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.basket {
  position: relative;

  &:hover svg {
    fill: $text-accent-color;
  }

  svg {
    width: 20px;
    height: 17px;
    fill: $text-color;
    transition: fill 0.3s ease-in-out;

    @include laptop() {
      width: 24px;
      height: 22px;
    }
  }

  &__count {
    top: -5px;
    right: -5px;
    width: 22px;
    padding: 4px 4px 2px;
    display: inline-block;
    position: absolute;
    background-color: $red;
    font-size: 12px;
    line-height: 10px;
    color: $text-accent-color;
    border-radius: 16px;
    box-sizing: border-box;
  }
}
</style>
