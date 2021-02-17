<template>
  <section class="hero">
<!--    <WinterHero v-if="isWinter" />-->
<!--    <SummerHero v-else />-->
    <SummerHero />
    <div class="gradient" />
  </section>
</template>

<script>
import SummerHero from './SummerHero'
import WinterHero from './WinterHero'

export default {
  name: 'Hero',
  components: {WinterHero, SummerHero},
  data: () => ({
    isWinter: false,
  }),
  beforeMount() {
    const now = new Date()
    const month = now.getMonth()
    // Considered to be winter if the current date is between the 22nd of October and the 22nd of April
    this.isWinter = month === 9 ? now.getDate() >= 22 : month === 3 ? now.getDate() < 22 : month < 3 || month > 10
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

.hero {
  position: relative;
  height: 100%;
}

.gradient {
  @include tablets() {
    width: 100vw;
    height: 120px;
    bottom: 0;
    position: absolute;
    pointer-events: none;
    background: linear-gradient(180deg, rgba(111, 116, 120, 0) 0%, #6F7478 100%);
  }
}
</style>