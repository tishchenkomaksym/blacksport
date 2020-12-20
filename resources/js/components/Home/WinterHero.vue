<template>
  <div class="winter-hero">
    <img src="/img/hero/winter/cloud-left.png" class="winter-hero__cloud-left" alt="Cloud">
    <img src="/img/hero/winter/cloud-right.png" class="winter-hero__cloud-right" alt="Cloud">

    <template v-if="width < 768">
      <!--  Mobile images  -->
      <img src="/img/hero/winter/bg-mobile.png" class="winter-hero__bg-mobile" alt="">
      <img src="/img/hero/winter/bg2-mobile.png" class="winter-hero__bg2-mobile" alt="">
      <img src="/img/hero/winter/bg3-mobile.png" class="winter-hero__bg3-mobile" alt="">
      <img src="/img/hero/winter/man-mobile.png" class="winter-hero__man-mobile" alt="Man">
    </template>
    <template v-else>
      <!--  Desktop images  -->
      <img src="/img/hero/winter/bg.png" class="winter-hero__bg" alt="">
      <img src="/img/hero/winter/bg2.png" class="winter-hero__bg2" alt="">
      <img src="/img/hero/winter/bg3.png" class="winter-hero__bg3" alt="">
      <img src="/img/hero/winter/man.png" class="winter-hero__man" alt="Man">
    </template>
  </div>
</template>

<script>
import useWindowSize from '../../hooks/useWindowSize'

export default {
  name: 'WinterHero',
  setup() {
    const {width} = useWindowSize()

    return {
      width,
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

.winter-hero {
  height: 100vh;
  position: relative;
  background: linear-gradient(0deg, rgba(36, 55, 70, 0.3), rgba(36, 55, 70, 0.3)), linear-gradient(164.83deg, #116296 8.41%, #FFFFFF 89.34%);

  img {
    position: absolute;
  }

  &__bg-mobile {
    width: 100vw;
    bottom: 20vh;
  }

  &__bg2-mobile {
    width: 100vw;
    bottom: 0;
  }

  &__bg3-mobile {
    width: 100vw;
    bottom: 3vh;
  }

  &__man-mobile {
    width: 100vw;
    bottom: 0;
  }

  &__cloud-left {
    width: calc((325 * 100vw) / 320);
    top: 9vh;

    @include tablets() {
      width: calc((750 * 100vw) / 1440);
      max-width: 750px;
      top: 5vh;
    }
  }

  &__cloud-right {
    width: calc((200 * 100vw) / 320);
    right: -5vw;
    top: 5vh;

    @include tablets() {
      width: calc((410 * 100vw) / 1440);
      max-width: 410px;
      right: 0;
      top: -10vh;
    }
  }

  &__bg,
  &__bg2 {
    width: 100vw;
    bottom: 0;
  }

  &__bg3 {
    width: calc((1158 * 100vw) / 1440);
    max-width: 1158px;
    bottom: 0;
  }

  &__man {
    height: 100vh;
    right: 0;
    bottom: 0;
  }
}
</style>