<template>
  <div class="summer-hero">
    <img src="/img/hero/summer/cloud-3.png" class="summer-hero__cloud-3" alt="Cloud">
    <img src="/img/hero/summer/cloud-2.png" class="summer-hero__cloud-2" alt="Cloud">
    <img src="/img/hero/summer/cloud-1.png" class="summer-hero__cloud-1" alt="Cloud">

    <template v-if="width < 768">
      <!--  Mobile images  -->
      <img src="/img/hero/summer/city-mobile.png" class="summer-hero__city-mobile" alt="City">
      <img src="/img/hero/summer/skatepark-3-mobile.png" class="summer-hero__skatepark-3-mobile" alt="Skatepark">
      <img src="/img/hero/summer/skatepark-2-mobile.png" class="summer-hero__skatepark-2-mobile" alt="Skatepark">
      <img src="/img/hero/summer/skatepark-1-mobile.png" class="summer-hero__skatepark-1-mobile" alt="Skatepark">
    </template>
    <template v-else>
      <!--  Desktop images  -->
      <img src="/img/hero/summer/city.png" class="summer-hero__city" alt="City">
      <img src="/img/hero/summer/skatepark-3.png" class="summer-hero__skatepark-3" alt="Skatepark">
      <img src="/img/hero/summer/skatepark-2.png" class="summer-hero__skatepark-2" alt="Skatepark">
      <img src="/img/hero/summer/skatepark-1.png" class="summer-hero__skatepark-1" alt="Skatepark">
    </template>

    <img src="/img/hero/summer/man.png" class="summer-hero__man" alt="Man">
    <img src="/img/hero/summer/skateboard.png" class="summer-hero__skateboard" alt="Skateboard">
  </div>
</template>

<script>
import useWindowSize from '../../hooks/useWindowSize'

export default {
  name: 'SummerHero',
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

.summer-hero {
  height: 100vh;
  position: relative;

  img {
    position: absolute;
  }

  &__city-mobile {
    width: 100vw;
    bottom: 3vh;
  }

  &__skatepark-1-mobile {
    width: 100vw;
    bottom: 0;
  }

  &__skatepark-3-mobile {
    width: 100vw;
    bottom: 2vh;
    right: 0;
  }

  &__skatepark-2-mobile {
    width: 100vw;
    bottom: 0;
  }

  &__city {
    width: 100vw;
    bottom: 0;
  }

  &__skatepark-1 {
    width: calc((1255 * 100vw) / 1440);
    max-width: 1255px;
    bottom: 0;
  }

  &__skatepark-2 {
    width: calc((1470 * 100vw) / 1440);
    max-width: 1470px;
    bottom: 0;
  }

  &__skatepark-3 {
    width: calc((1048 * 100vw) / 1440);
    max-width: 1048px;
    right: 0;
    bottom: 0;
  }

  &__cloud-1 {
    width: ((235 * 100vw) / 320);
    top: 25vh;
    left: -30vw;

    @include tablets() {
      width: 563px;
      top: 22vh;
      right: 61vw;
      left: initial;
    }
  }

  &__cloud-2 {
    width: calc((275 * 100vw) / 320);
    top: 18vh;
    right: -28vw;

    @include tablets() {
      width: 658px;
      top: 6vh;
      right: initial;
      left: 45vw;
    }
  }

  &__cloud-3 {
    width: calc((157 * 100vw) / 320);
    left: 7vw;
    top: 12vh;

    @include tablets() {
      width: 375px;
      right: 74vw;
      left: initial;
      top: 9vh;
    }
  }

  &__man {
    width: calc((242 * 100vw) / 320);
    right: -8vw;
    top: 20vh;
    transform: rotate(-15deg);

    @include tablets() {
      width: 477px;
      left: 53vw;
      right: initial;
      top: 9vh;
      transform: initial;
    }
  }

  &__skateboard {
    width: calc((86 * 100vw) / 320);
    top: 62vh;
    left: 12vw;
    transform: rotate(-15deg);

    @include tablets() {
      width: 170px;
      top: 52vh;
      left: 39vw;
      transform: initial;
    }
  }
}
</style>
