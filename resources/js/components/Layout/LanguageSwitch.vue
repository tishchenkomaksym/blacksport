<template>
  <div>
    <div class="lang-list">
      <button class="lang">
        ua
      </button>
      <button class="lang">
        en
      </button>
    </div>
    <button class="lang lang--active">
      ru
    </button>
  </div>
</template>

<script>
export default {
  name: 'LanguageSwitch',
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

.lang {
  width: 24px;
  padding: 0 2px;
  text-transform: uppercase;
  border-radius: 100%;
  border-color: transparent;
  border-width: 1px;
  border-style: solid;
  color: $text-color;
  background-color: transparent;
  font-size: 12px;
  line-height: 22px;
  transition: color .3s ease, border-color .3s ease;
  will-change: color, border-color;

  &--active {
    border-color: $text-color;
  }

  &:hover {
    color: $text-accent-color;
    border-color: $text-accent-color;
  }
}

.lang-list {
  position: absolute;
  opacity: 0;
  visibility: hidden;
}
</style>