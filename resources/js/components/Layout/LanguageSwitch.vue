<template>
  <div class="languages">
    <button class="languages__item languages__item--active">
      {{currentLocale}}
    </button>
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
</template>

<script>
import {computed} from 'vue'
import {useRoute} from 'vue-router'
import {useI18n} from '../../i18nPlugin'
import {LANGS, ROUTE_CONF} from '../../router'

export default {
  name: 'LanguageSwitch',
  setup() {
    const i18n = useI18n()
    const currentLocale = computed(() => i18n.locale.value)
    const locales = computed(() => LANGS.filter(locale => locale !== currentLocale.value))
    const currentRoute = computed(() => {
      const currentRoute = Object.values(ROUTE_CONF).find(({name}) => name === useRoute().matched[0]?.name)
      return (currentRoute || ROUTE_CONF.HOME).path
    })

    return {
      currentLocale,
      currentRoute,
      locales,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

.languages {
  &:hover {
    .languages__list {
      transform: translateY(-100%);
      opacity: 1;
      visibility: visible;
      transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
      will-change: opacity, transform;
    }
  }

  &__item {
    width: 24px;
    display: block;
    padding: 0 2px;
    text-transform: uppercase;
    border-radius: 100%;
    border-color: transparent;
    border-width: 1px;
    border-style: solid;
    color: $text-color;
    background-color: transparent;
    font-size: 12px;
    line-height: 22px;
    transition: color .3s ease, border-color .3s ease;
    will-change: color, border-color;
    box-sizing: border-box;
    text-decoration: none;

    &:hover {
      color: $text-accent-color;
      border-color: $text-accent-color;
    }

    &--active {
      border-color: $text-color;
    }
  }

  &__list {
    top: 0;
    position: absolute;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out, visibility 0s 0.3s;
    will-change: opacity, transform;

    .languages__item {
      margin-bottom: 16px;
    }
  }
}
</style>
