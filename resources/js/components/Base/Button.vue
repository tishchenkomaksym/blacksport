<template>
  <button
    :class="buttonClassNames"
    :style="buttonStyles"
  >
    <slot />
  </button>
</template>

<script>
import {computed} from 'vue'

export default {
  name: 'Button',
  props: {
    block: {
      type: Boolean,
      default: false,
    },
    link: {
      type: Boolean,
      default: false,
    },
    light: {
      type: Boolean,
      default: false,
    },
    small: {
      type: Boolean,
      default: false,
    },
    color: {
      type: String,
      default: null,
    },
  },
  setup({block, link, light, small, color}) {
    const buttonClassNames = computed(() => ({
      block,
      link,
      light,
      small,
    }))

    const buttonStyles = computed(() => ({
      backgroundColor: color,
    }))

    return {
      buttonClassNames,
      buttonStyles,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

button {
  padding: $spacing;
  display: flex;
  align-items: center;
  color: $text-color;
  font-weight: 700;
  text-transform: uppercase;
  background-color: $smoke;
  transition: all 0.3s ease-in-out;
  font-size: 15px;
  letter-spacing: 0.05em;

  @include tablets() {
    padding: $spacing $spacing + $spacing-md;
    font-size: 18px;
  }

  &:disabled {
    opacity: 0.75;
  }

  &:hover:not(:disabled):not(.link) {
    background-color: $park;
  }

  &.block {
    width: 100%;
    display: block;
  }

  &.link {
    padding: 0;
    background-color: transparent;

    &:hover:not(:disabled) {
      color: $text-accent-color;
    }
  }

  &.light {
    background-color: $text-color;
    color: $smoke;
  }

  &.small {
    padding: $spacing-sm;
  }
}
</style>