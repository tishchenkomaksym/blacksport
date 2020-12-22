<template>
  <transition name="slide">
    <div class="languages" v-if="!isHidden">
      <div class="languages__item languages__item--active">
        {{currentLocale}}
      </div>
      <div class="languages__list">
        <router-link
          :key="locale"
          :to="`/${locale}${currentRoute}`"
          class="languages__item"
          v-for="locale in locales"
        >
          {{locale}}
        </router-link>
      </div>
    </div>
  </transition>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import {useRoute} from 'vue-router'
import {useI18n} from '../../i18nPlugin'
import useWindowSize from '../../hooks/useWindowSize'
import {LANGS, ROUTE_CONF} from '../../router'

export default {
  name: 'LanguageSwitch',
  setup() {
    const i18n = useI18n()
    const {state} = useStore()
    const currentLocale = computed(() => i18n.locale.value)
    const locales = computed(() => LANGS.filter(locale => locale !== currentLocale.value))
    const currentRoute = computed(() => {
      const currentRoute = Object.values(ROUTE_CONF).find(({name}) => name === useRoute().matched[0]?.name)
      return (currentRoute || ROUTE_CONF.HOME).path
    })
    const {width} = useWindowSize()
    const menuShown = computed(() => state.common.menuShown)

    return {
      currentLocale,
      currentRoute,
      locales,
      isHidden: computed(() => !menuShown.value && width.value < 768),
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.languages {
  position: relative;
  display: flex;
  flex-flow: row-reverse;

  @include tablets() {
    display: initial;

    &:hover {
      .languages__list {
        transform: translateY(-100%);
        opacity: 1;
        visibility: visible;
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        will-change: opacity, transform;
      }
    }
  }

  &__item {
    width: 24px;
    display: block;
    padding: 0 2px;
    text-transform: uppercase;
    border-radius: 100%;
    border-color: $text-color;
    border-width: 1px;
    border-style: solid;
    color: $text-color;
    font-size: 12px;
    line-height: 22px;
    transition: color .3s ease, border-color .3s ease;
    will-change: color, border-color;
    box-sizing: border-box;

    &:hover {
      color: $text-accent-color;
      border-color: $text-accent-color;
    }

    @include tablets() {
      border-color: transparent;
    }

    &--active {
      color: $park;
      border-color: $park;

      @include tablets() {
        color: $text-color;
        border-color: $text-color;
      }
    }
  }

  &__list {
    display: flex;
    right: 24px;
    top: 0;

    @include tablets() {
      display: initial;
      right: auto;
      opacity: 0;
      visibility: hidden;
      position: absolute;
      transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out, visibility 0s 0.3s;
      will-change: opacity, transform;
      transform: translateY(-24px);
    }

    .languages__item {
      margin-right: 16px;

      @include tablets() {
        margin-right: 0;
        margin-bottom: 16px;
      }
    }
  }
}

.slide {
  &-enter-active,
  &-leave-active {
    transition: transform 0.5s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    transform: translateX(calc(100% + 24px));
  }
}
</style>
