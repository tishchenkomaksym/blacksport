<template>
  <button
    :class="{link: link}"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'Button',
  props: {
    link: Boolean,
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

button {
  padding: 16px;
  color: $text-color;
  font-weight: 700;
  text-transform: uppercase;
  background-color: $smoke;
  transition: all 0.3s ease-in-out;
  font-size: 15px;
  letter-spacing: 0.05em;

  @include tablets() {
    padding: 16px 32px;
    font-size: 18px;
  }

  &:hover {
    background-color: $park;
  }

  &.link {
    padding: 0;
    background-color: transparent;

    &:hover {
      color: $text-accent-color;
    }
  }
}
</style>