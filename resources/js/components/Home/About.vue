<template>
  <section class="about">
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

  &__content {
    height: 75vh;
    padding-top: 24px;
    padding-bottom: 40px;
    background-color: $park;
    box-sizing: border-box;

    @include laptop() {
      height: 70vh;
      padding: 40px;
    }
  }

  .container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 16px;

    @include laptop() {
      padding: 0;
      grid-template-columns: repeat(3, 1fr);
      column-gap: 40px;
    }

    @include large-desktop() {
      grid-template-columns: 440px 1fr 440px;
    }
  }

  img {
    max-width: 100%;
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