<template>
  <transition appear name="logo-transition">
    <router-link
      :to="`/${locale}`"
      :class="{blurred: shownServiceExample || shownServiceOrder}"
      @click.prevent="goToPage(`/${locale}`)"
      class="logo"
    >
      <img src="/img/blacksport_logo.svg" alt="Blacksport">
    </router-link>
  </transition>
  <transition appear name="right-panel-transition">
    <div class="right-panel" :class="{blurred: shownServiceExample || shownServiceOrder}">
      <BasketIcon/>
      <router-link
        :to="`/${locale}`"
        class="link right-panel__home-link"
      >
        {{t(basketOpen ? 'basket' : 'home')}}
      </router-link>
      <button
        :class="{'right-panel__burger--opened': menuShown || basketOpen}"
        @click="basketOpen ? toggleBasket(false) : toggleMenu(!menuShown)"
        class="right-panel__burger"
      />
    </div>
  </transition>
  <transition name="nav-transition">
    <nav v-if="menuShown">
      <router-link
        :data-link="link.name"
        :key="i"
        :to="link.path"
        @click.prevent="goToPage(link.path)"
        class="link"
        v-for="(link, i) in links"
      >
        {{t(link.name)}}
      </router-link>
    </nav>
  </transition>
  <transition name="terms-transition">
    <div class="navigation-terms" v-if="menuShown">
      <router-link
        :to="termsLink"
        @click.prevent="goToPage(termsLink)"
        class="basic"
      >
        {{t('termsAndConditions')}}
      </router-link>
      <router-link
        :to="termsLink"
        @click.prevent="goToPage(refundLink)"
        class="basic"
      >
        {{t('refundPolicy')}}
      </router-link>
    </div>
  </transition>
</template>

<script>
import {computed} from 'vue'
import {useRouter} from 'vue-router'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import {ROUTE_CONF} from '../../router'

import BasketIcon from '../Products/BasketIcon'

export default {
  name: 'Header',
  components: {BasketIcon},
  setup() {
    const {t, locale} = useI18n()
    const {state, commit} = useStore()
    const router = useRouter()
    const menuShown = computed(() => state.common.menuShown)
    const basketOpen = computed(() => state.common.basketOpen)
    const shownServiceExample = computed(() => state.common.shownServiceExample)
    const shownServiceOrder = computed(() => state.common.shownServiceOrder)
    const links = computed(() => [
      {
        path: {
          name: ROUTE_CONF.HOME.name,
          params: {locale: locale.value},
        },
        name: 'home',
      },
      {
        path: {
          name: ROUTE_CONF.NEWS.name,
          params: {locale: locale.value},
        },
        name: 'news',
      },
      {
        path: {
          name: ROUTE_CONF.ABOUT.name,
          params: {locale: locale.value},
        },
        name: 'about',
      },
      {
        path: {
          name: ROUTE_CONF.SERVICES.name,
          params: {locale: locale.value},
        },
        name: 'services',
      },
      {
        path: {
          name: ROUTE_CONF.PRODUCTS.name,
          params: {locale: locale.value},
        },
        name: 'products',
      },
      {
        path: {
          name: ROUTE_CONF.PROGRAMS.name,
          params: {locale: locale.value},
        },
        name: 'programs',
      },
      {
        path: {
          name: ROUTE_CONF.CONTACTS.name,
          params: {locale: locale.value},
        },
        name: 'contacts',
      },
    ])

    const toggleMenu = menuShown => commit('common/setMenuShown', menuShown)
    const toggleBasket = basketShown => commit('common/setBasketOpen', basketShown)

    const goToPage = path => {
      toggleMenu(false)
      toggleBasket(false)
      router.push(path)
    }

    return {
      t,
      locale,
      menuShown,
      toggleMenu,
      toggleBasket,
      links,
      goToPage,
      basketOpen,
      shownServiceExample,
      shownServiceOrder,
      termsLink: computed(() => `/${locale.value}${ROUTE_CONF.TERMS.path}`),
      refundLink: computed(() => `/${locale.value}${ROUTE_CONF.REFUND.path}`),
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.blurred {
  filter: blur(16px);
}

.logo {
  top: $spacing-md - $spacing-sm / 2;
  left: $spacing;
  opacity: 0.2;
  position: fixed;
  z-index: 2;
  transition: opacity 0.3s ease-in-out, filter 0.3s ease-in-out;

  &:hover {
    opacity: 1;
  }

  @include tablets() {
    top: 46px;
    left: $spacing-lg;
  }

  img {
    height: $spacing-md;

    @include tablets() {
      height: $spacing-md + $spacing-sm;
    }
  }
}

.right-panel {
  position: fixed;
  z-index: 2;
  top: $spacing-md - $spacing-sm / 4;
  right: $spacing;
  display: grid;
  grid-template-columns: auto auto;
  align-items: center;
  column-gap: 10px;
  transition: filter 0.3s ease-in-out;

  @include tablets() {
    top: $spacing-lg + $spacing-sm / 2 + 2px;
    right: $spacing-lg;
    grid-template-columns: repeat(3, auto);
  }

  @include laptop() {
    column-gap: $spacing;
  }

  &__home-link {
    display: none;

    @include tablets() {
      display: block;
    }
  }

  &__burger {
    $top-line-width: 20px;
    $bottom-line-width: 14px;
    $line-distance: 8px;
    $burger-size: $top-line-width + 4px;
    $line-height: 2px;
    $top-line-top: ($burger-size - (2px * 2) - $line-distance) / 2;
    $bottom-line-top: $burger-size - $top-line-top - $line-height;

    width: $burger-size;
    height: $burger-size;
    padding: 0;
    border: none;
    position: relative;

    &:hover {
      &::before, &::after {
        background-color: $text-accent-color;
      }
    }

    &::before, &::after {
      height: $line-height;
      content: '';
      display: block;
      position: absolute;
      background-color: $text-color;
      border-radius: $line-height;
      transform: translateX(-50%);
      transition: all 0.3s ease-in-out;
      will-change: transform, width, left, top, background-color;
    }

    &::before {
      width: $top-line-width;
      top: $top-line-top;
      left: 50%;
    }

    &::after {
      width: $bottom-line-width;
      top: $bottom-line-top;
      left: calc(50% + 3px);
    }

    &--opened {
      &::before {
        width: 24px;
        top: 45%;
        left: 0;
        transform: rotate(-45deg) translateX(0);
      }

      &::after {
        width: 20px;
        top: 40%;
        left: 0;
        transform: rotate(45deg) translateX(0);
      }
    }
  }
}

nav {
  top: 50px;
  width: 100vw;
  height: calc(100vh - 170px);
  padding: 35px $spacing;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow-y: auto;
  position: fixed;
  z-index: 1;

  @include landscape() {
    height: calc(100vh - 100px);
  }

  @include tablets() {
    top: 70px;
    width: initial;
    height: initial;
    max-height: calc(100vh - 130px);
    right: 0;
    align-items: flex-end;
    padding: 46px $spacing-lg #{$spacing-lg + $spacing-md - $spacing-sm / 2};
  }

  .link {
    display: inline-block;

    &:not(:last-of-type) {
      margin-bottom: 28px;
    }

    @include tablets() {
      &[data-link="home"] {
        display: none;
      }
    }
  }
}

.navigation-terms {
  position: fixed;
  left: 0;
  right: 0;
  margin: 0 auto;
  z-index: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  bottom: $spacing-lg * 2;

  @include landscape() {
    display: none;
  }

  @include tablets() {
    display: flex;
    padding: $spacing $spacing-lg;
    bottom: 100px;
    left: initial;
    margin: initial;
    align-items: flex-end;
  }

  a:first-of-type {
    margin-bottom: $spacing-sm;

    @include tablets() {
      margin-bottom: $spacing-md;
    }
  }
}

.nav-transition {
  &-enter-active,
  &-leave-active {
    transition: transform 0.5s ease-in-out;

    a {
      transition: margin-bottom 0.5s ease-in-out;
    }

    @include tablets() {
      transition: opacity 0.3s ease-in-out;

      a {
        transition: none;
      }
    }
  }

  &-enter-from,
  &-leave-to {
    @media screen and (orientation: portrait) {
      transform: translateY(calc(-100% + 175px));
    }

    @media screen and (orientation: landscape) {
      transform: translateY(calc(-100% - 25px));
    }

    a:not(:last-of-type) {
      margin-bottom: 0;
    }

    @include tablets() {
      transform: none;
      opacity: 0;

      a:not(:last-of-type) {
        margin-bottom: 28px;
      }
    }
  }
}

.logo-transition {
  &-enter-active {
    transition: transform 0.75s ease-in-out, opacity 0.75s ease-in-out;

    @include laptop() {
      transition: transform 1s ease-in-out, opacity 1s ease-in-out;
    }
  }

  &-enter-from {
    opacity: 0;
    transform: translateX(-100%);
  }
}

.right-panel-transition {
  &-enter-active {
    transition: transform 0.75s ease-in-out, opacity 0.75s ease-in-out;

    @include laptop() {
      transition: transform 1s ease-in-out, opacity 1s ease-in-out;
    }
  }

  &-enter-from {
    opacity: 0;
    transform: translateX(100%);
  }
}

.terms-transition {
  &-enter-active,
  &-leave-active {
    transition: opacity 0.5s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
  }
}
</style>
