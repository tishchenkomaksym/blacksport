<template>
  <button
    :class="buttonClassNames"
    :style="buttonStyles"
  >
    <slot />
  </button>
</template>

<script>
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
  computed: {
    buttonClassNames() {
      return {
        block: this.block,
        link: this.link,
        light: this.light,
        small: this.small,
      }
    },
    buttonStyles() {
      return {
        backgroundColor: this.color,
      }
    },
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
    position: relative;

    &:hover:not(:disabled) {
      color: $text-accent-color;

      &::after {
        opacity: 0.3;
      }
    }

    &::after {
      width: calc(100% + #{$spacing});
      top: 50%;
      transform: translateY(calc(-50% - 1px));
      left: -$spacing-sm;
      height: 4px;
      display: block;
      background-color: $text-color;
      opacity: 0;
      content: "";
      position: absolute;
      transition: opacity 0.3s ease-in-out;
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