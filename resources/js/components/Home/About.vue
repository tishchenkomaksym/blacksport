<template>
  <section class="about">
    <img
      @click="$emit('switch-slide', 'hero')"
      src="/img/blacksport_logo.svg"
      class="about__logo"
      alt="Blacksport"
    />
    <div class="about__content">
      <div class="container">
        <img src="/img/about/about-1.png" alt="Snowboarding">
        <img src="/img/about/about-2.png" class="about__img2" alt="Man playing football">
        <div class="about__text">
          <h1>{{i18n.$t('defaults.about')}}</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua.</p>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.</p>
          <div class="about__footer">
            <router-link
              :to="aboutPath"
              class="link link--smaller"
            >
              {{i18n.$t('defaults.readMore')}}
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {useI18n} from '../../i18nPlugin'
import {ROUTE_CONF} from '../../router'
import {computed} from 'vue'

export default {
  name: 'About',
  setup() {
    const i18n = useI18n()

    return {
      i18n,
      aboutPath: computed(() => ({
        name: ROUTE_CONF.ABOUT.name,
        params: {locale: i18n.locale.value},
      })),
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.about {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;

  &__logo {
    width: calc(100vw - 32px);
    max-width: 696px;
    margin: 0 auto;
    cursor: pointer;
  }

  &__content {
    margin-top: 16px;
    height: 75vh;
    padding-top: 24px;
    padding-bottom: 40px;
    background-color: $park;
    box-sizing: border-box;

    @include laptop() {
      height: 70vh;
      padding: 0;
    }

    @include desktop() {
      margin-top: 40px;
    }
  }

  .container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 16px;

    @include tablets() {
      padding: 0 48px;
    }

    @include laptop() {
      padding: 40px 48px;
      grid-template-columns: repeat(3, 1fr);
      column-gap: 40px;
    }

    @include large-desktop() {
      grid-template-columns: 440px 1fr 440px;
    }

    img {
      max-width: 100%;
      filter: drop-shadow(4px 4px 16px rgba(0, 0, 0, 0.08));

      @include tablets() {
        filter: drop-shadow(16px 16px 32px rgba(0, 0, 0, 0.08));
      }
    }
  }

  &__img2 {
    @include laptop() {
      grid-column: 3;
    }
  }

  &__text {
    grid-column: 1 / 2 span;

    @include laptop() {
      grid-row: 1;
      grid-column: 2;
    }
  }

  &__footer {
    display: flex;
    justify-content: flex-end;
  }
}
</style>