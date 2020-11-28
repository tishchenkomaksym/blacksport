<template>
  <footer>
    <Socials/>
    <LanguageSwitch/>
  </footer>
</template>

<script>
import LanguageSwitch from './LanguageSwitch'
import Socials from './Socials'

export default {
  name: 'Footer',
  components: {Socials, LanguageSwitch},
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

footer {
  width: 100%;
  bottom: 0;
  padding: 0 48px 48px;
  box-sizing: border-box;
  display: flex;
  justify-content: space-between;
  position: absolute;
}
</style>