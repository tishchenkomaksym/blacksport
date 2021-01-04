<template>
  <button>
    <slot />
  </button>
</template>

<script>
export default {
  name: 'Button',
  props: {

  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

button {
  padding: 16px;
  display: block;
  color: $text-color;
  font-weight: 700;
  text-transform: uppercase;
  background-color: $smoke;
  transition: background-color 0.3s ease-in-out;
  font-size: 15px;

  @include tablets() {
    padding: 16px 32px;
    font-size: 18px;
  }

  &:hover {
    background-color: $park;
  }
}
</style>