<template>
  <button class="prev-section-button">
    <span class="prev-section-button__arrow" />
    <span class="prev-section-button__title">{{title}}</span>
  </button>
</template>

<script>
export default {
  name: 'PrevSectionButton',
  props: {
    title: String,
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.prev-section-button {
  max-width: 200px;
  margin: 0 auto;
  color: $text-accent-color;
  font-weight: 300;
  font-size: 14px;
  text-transform: uppercase;
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;

  &__arrow {
    display: block;
    position: relative;

    &::before, &::after {
      display: block;
      content: '';
    }

    &::before {
      width: 1px;
      height: 23px;
      background-color: $text-accent-color;

      @include laptop() {
        height: 35px;
      }
    }

    &::after {
      position: absolute;
      top: -2px;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 11px 0 0 5px;
      border-color: transparent transparent transparent $text-accent-color;
    }
  }

  &__title {
    padding: 10px 2px 0;
    border-top: 1px solid $text-accent-color;
  }
}
</style>