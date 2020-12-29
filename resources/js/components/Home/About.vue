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
          <p v-if="about">{{about.meta_description}}</p>
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
import {computed} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../../i18nPlugin'
import {ROUTE_CONF} from '../../router'

export default {
  name: 'About',
  setup() {
    const {getters} = useStore()
    const i18n = useI18n()
    const about = computed(() => getters['home/about'])

    return {
      i18n,
      about,
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

    @include landscape() {
      width: 30vw;
    }
  }

  &__content {
    margin-top: 16px;
    height: 75vh;
    padding-top: 24px;
    padding-bottom: 40px;
    background-color: $park;
    box-sizing: border-box;

    @include landscape() {
      height: 70vh;
      overflow-y: auto;
    }

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
      padding: 0 40px;
    }

    @include laptop() {
      padding: 40px;
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

      h1 {
        margin-top: 0;
      }

      p {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 12;
        -webkit-box-orient: vertical;
      }
    }
  }

  &__footer {
    display: flex;
    justify-content: flex-end;
  }
}
</style>