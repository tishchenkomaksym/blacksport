<template>
  <div class="winter-hero">
    <img src="/img/hero/winter/cloud-left.png" class="winter-hero__cloud-left" alt="Cloud">
    <img src="/img/hero/winter/cloud-right.png" class="winter-hero__cloud-right" alt="Cloud">
    <img src="/img/hero/winter/bg1.png" class="winter-hero__bg1" alt="">
    <img src="/img/hero/winter/bg2.png" class="winter-hero__bg2" alt="">
    <img src="/img/hero/winter/bg3.png" class="winter-hero__bg3" alt="">
    <img src="/img/hero/winter/man.png" class="winter-hero__man" alt="Man">
  </div>
</template>

<script>
export default {
  name: 'WinterHero',
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

  &__bg1 {
    width: calc((736 * 100vw) / 320);
    bottom: 22vh;
    left: -64vw;

    @include laptop() {
      width: calc((1966 * 100vw) / 1440);
      bottom: 3vh;
      left: -18vw;
    }
  }

  &__bg2 {
    width: calc((792 * 100vw) / 320);
    bottom: 5vh;
    left: -80vw;

    @include laptop() {
      width: calc((1681 * 100vw) / 1440);
      bottom: 1vh;
      left: -8vw;
    }
  }

  &__bg3 {
    width: calc((524 * 100vw) / 320);
    bottom: 0;
    left: -73vw;

    @include laptop() {
      width: calc((1158 * 100vw) / 1440);
      bottom: -1vh;
      left: -10vw;
    }
  }

  &__man {
    width: calc((822 * 100vw) / 320);
    left: -116vw;
    bottom: -15vh;
    transform: rotate(-3deg);

    @include laptop() {
      width: calc((2094 * 100vw) / 1440);
      max-width: 2094px;
      left: initial;
      right: -3vw;
      bottom: -49vh;
      transform: initial;
    }
  }

  &__cloud-left {
    width: calc((325 * 100vw) / 320);
    top: 10vh;

    @include tablets() {
      width: calc((750 * 100vw) / 1440);
      max-width: 750px;
      top: 5vh;
    }
  }

  &__cloud-right {
    width: calc((200 * 100vw) / 320);
    right: -10vw;
    top: 10vh;

    @include tablets() {
      width: calc((410 * 100vw) / 1440);
      max-width: 410px;
      right: 0;
      top: -10vh;
    }
  }
}
</style>