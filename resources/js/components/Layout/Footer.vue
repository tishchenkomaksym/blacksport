<template>
  <footer>
    <div class="container">
      <Socials/>
      <LanguageSwitch/>
    </div>
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
  width: 100vw;
  padding: 0 24px 24px;
  position: absolute;
  bottom: 0;
  box-sizing: border-box;

  @include tablets() {
    padding: 0 48px 48px;
  }

  .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
}
</style>