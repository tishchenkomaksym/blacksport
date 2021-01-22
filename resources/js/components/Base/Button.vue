<template>
  <button
    :class="{block, link, light}"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'Button',
  props: {
    block: Boolean,
    link: Boolean,
    light: Boolean,
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

  &:hover {
    background-color: $park;
  }

  &.block {
    width: 100%;
    display: block;
  }

  &.link {
    padding: 0;
    background-color: transparent;

    &:hover {
      color: $text-accent-color;
    }
  }

  &.light {
    background-color: $text-color;
    color: $smoke;
  }
}
</style>