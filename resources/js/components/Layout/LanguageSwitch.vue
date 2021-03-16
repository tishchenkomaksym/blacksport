<template>
  <transition appear name="slide">
    <div
      :class="{'languages--blurred': isBlurred}"
      class="languages"
      v-if="!isHidden"
    >
      <div class="languages__item languages__item--active">
        {{locale}}
      </div>
      <div class="languages__list">
        <div
          :key="locale"
          @click="switchLocale(locale)"
          class="languages__item"
          v-for="locale in locales"
        >
          {{locale}}
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import {useRoute} from 'vue-router'
import {useI18n} from 'vue-i18n'
import useWindowSize from '../../hooks/useWindowSize'
import {LANGS} from '../../i18n'
import {ROUTE_CONF} from '../../router'

export default {
  name: 'LanguageSwitch',
  setup() {
    const {locale} = useI18n()
    const {state} = useStore()
    const locales = computed(() => LANGS.filter(lang => lang !== locale.value))
    const currentRoute = computed(() => {
      const currentRoute = Object.values(ROUTE_CONF).find(({name}) => name === useRoute().matched[0]?.name)
      return (currentRoute || ROUTE_CONF.HOME).path
    })
    const {width} = useWindowSize()
    const menuShown = computed(() => state.common.menuShown)

    const switchLocale = newLocale => locale.value = newLocale

    return {
      locale,
      switchLocale,
      currentRoute,
      locales,
      isHidden: computed(() => !menuShown.value && width.value < 768),
      isBlurred: computed(() => {
        return state.common.shownServiceExample || state.common.shownServiceOrder || state.common.shownAchievement
      }),
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.languages {
  display: flex;
  flex-flow: row-reverse;
  position: fixed;
  z-index: 1;
  right: $spacing-md;
  bottom: $spacing-md;
  transition: filter 0.3s ease-in-out;

  @include tablets() {
    display: initial;
    right: $spacing-lg + $spacing-sm;
    bottom: $spacing-lg + $spacing-sm;

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

  &--blurred {
    filter: blur(16px);
  }

  &__item {
    width: $spacing-md;
    height: $spacing-md;
    display: block;
    padding: 0 2px;
    text-transform: uppercase;
    border-radius: 100%;
    border-color: $text-color;
    border-width: 1px;
    border-style: solid;
    color: $text-color;
    font-size: 12px;
    line-height: $spacing-md;
    transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out;
    will-change: color, border-color;
    box-sizing: border-box;

    &:hover:not(&--active) {
      color: $text-accent-color;
      border-color: $text-accent-color;
      cursor: pointer;
    }

    @include tablets() {
      border-color: transparent;
    }

    &--active {
      opacity: 0.5;

      @include tablets() {
        opacity: 1;
        color: $text-color;
        border-color: $text-color;
      }
    }
  }

  &__list {
    display: flex;
    right: $spacing-md;
    top: 0;

    @include tablets() {
      display: initial;
      right: auto;
      opacity: 0;
      visibility: hidden;
      position: absolute;
      transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out, visibility 0s 0.3s;
      will-change: opacity, transform;
      transform: translateY(#{-$spacing-md});
    }

    .languages__item {
      margin-right: $spacing;

      @include tablets() {
        margin-right: 0;
        margin-bottom: $spacing;
      }
    }
  }
}

.slide {
  &-enter-active,
  &-leave-active {
    transition: transform 0.5s ease-in-out;

    @include laptop() {
      transition: transform 1s ease-in-out;
    }
  }

  &-enter-from,
  &-leave-to {
    transform: translateX(calc(100% + #{$spacing-md}));
  }
}
</style>
