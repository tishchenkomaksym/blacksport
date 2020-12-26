<template>
  <img src="/img/hero/summer/cloud-3.png" class="cloud-3" alt="Cloud">
  <img src="/img/hero/summer/cloud-2.png" class="cloud-2" alt="Cloud">
  <img src="/img/hero/summer/cloud-1.png" class="cloud-1" alt="Cloud">
  <img src="/img/hero/summer/city.png" class="city" alt="City">
  <img src="/img/hero/summer/skatepark-3.png" class="skatepark-3" alt="Skatepark">
  <img src="/img/hero/summer/skatepark-2.png" class="skatepark-2" alt="Skatepark">
  <img src="/img/hero/summer/skatepark-1.png" class="skatepark-1" alt="Skatepark">
  <img src="/img/hero/summer/man.png" class="man" alt="Man">
  <img src="/img/hero/summer/skateboard.png" class="skateboard" alt="Skateboard">
</template>

<script>
export default {
  name: 'SummerHero',
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

img {
  position: absolute;
}

.cloud-1 {
  width: ((235 * 100vw) / 320);
  top: 25vh;
  left: -30vw;
  transform: matrix(-1, 0, 0, 1, 0, 0);

  @include laptop() {
    width: 563px;
    top: 22vh;
    right: 61vw;
    left: initial;
  }
}

.cloud-2 {
  width: calc((275 * 100vw) / 320);
  top: 18vh;
  right: -28vw;

  @include laptop() {
    width: 658px;
    top: 6vh;
    right: initial;
    left: 45vw;
  }
}

.cloud-3 {
  width: calc((157 * 100vw) / 320);
  left: 7vw;
  top: 12vh;

  @include laptop() {
    width: 375px;
    right: 74vw;
    left: initial;
    top: 9vh;
  }
}

.city {
  width: calc((872 * 100vw) / 320);
  left: -86vw;
  bottom: 3vh;

  @include tablets() {
    bottom: 0;
  }

  @include laptop() {
    width: calc((2010 * 100vw) / 1440);
    left: -27vw;
    bottom: -18vh;
  }
}

.skatepark-1 {
  width: calc((477 * 100vw) / 320);
  bottom: -14vh;
  left: -50vw;

  @include tablets() {
    bottom: -30vh;
    left: -30vw;
  }

  @include laptop() {
    width: calc((1219 * 100vw) / 1440);
    bottom: -49vh;
    left: 0;
  }
}

.skatepark-2 {
  width: calc((801 * 100vw) / 320);
  bottom: -24vh;
  left: -118vw;

  @include laptop() {
    width: calc((2048 * 100vw) / 1440);
    bottom: -64vh;
    left: -39vw;
  }
}

.skatepark-3 {
  width: calc((410 * 100vw) / 320);
  bottom: 2vh;
  right: -27vw;

  @include laptop() {
    width: calc((1048 * 100vw) / 1440);
    bottom: -23vh;
    left: 28vw;
    right: auto;
  }
}

.man {
  width: calc((242 * 100vw) / 320);
  right: -8vw;
  top: 20vh;
  transform: rotate(-15deg);

  @include tablets() {
    top: 15vh;
  }

  @include laptop() {
    width: 477px;
    left: 53vw;
    right: initial;
    top: 9vh;
    transform: initial;
  }
}

.skateboard {
  width: calc((86 * 100vw) / 320);
  top: 62vh;
  left: 12vw;
  transform: rotate(-15deg);

  @include laptop() {
    width: 170px;
    top: 52vh;
    left: 39vw;
    transform: initial;
  }
}
</style>
