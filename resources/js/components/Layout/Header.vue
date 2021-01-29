<template>
  <transition name="overlay-transition">
    <div
      @click="toggleMenu"
      class="overlay"
      v-if="menuShown"
    />
  </transition>
  <transition appear name="logo-transition">
    <router-link
      :to="`/${locale}`"
      class="logo"
    >
      <img src="/img/blacksport_logo.svg" alt="Blacksport">
    </router-link>
  </transition>
  <transition appear name="right-panel-transition">
    <div class="right-panel">
      <BasketIcon/>
      <router-link
        :to="`/${locale}`"
        class="link right-panel__home-link"
      >
        {{t('home')}}
      </router-link>
      <button
        :class="{'right-panel__burger--opened': menuShown}"
        @click="toggleMenu"
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

    const toggleMenu = () => commit('common/toggleMenu')

    const goToPage = path => {
      toggleMenu()
      router.push(path)
    }

    return {
      t,
      locale,
      menuShown: computed(() => state.common.menuShown),
      toggleMenu,
      links,
      goToPage,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.overlay {
  width: 100vw;
  height: 100vh;
  position: absolute;
  z-index: 1;
  background-color: rgba($bg-color, 0.25);
}

.logo {
  top: $spacing-md - $spacing-sm / 2;
  left: $spacing;
  opacity: 0.2;
  position: absolute;
  z-index: 1;
  transition: opacity 0.3s ease-in-out;

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
  position: absolute;
  z-index: 1;
  top: $spacing-md - $spacing-sm / 4;
  right: $spacing;
  display: grid;
  grid-template-columns: auto auto;
  align-items: center;
  column-gap: 10px;

  @include tablets() {
    top: $spacing-lg + $spacing-sm / 2;
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
  height: calc(100vh - 100px);
  padding: 35px $spacing;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow-y: auto;
  position: absolute;
  z-index: 1;

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
    margin-bottom: 28px;

    @include tablets() {
      &[data-link="home"] {
        display: none;
      }
    }
  }
}

.overlay-transition {
  &-enter-active,
  &-leave-active {
    transition: opacity 0.3s ease-in-out;
  }

  &-enter-from,
  &-leave-to {
    opacity: 0;
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
      transform: translateY(calc(-100% + 250px));
    }

    @media screen and (orientation: landscape) {
      transform: translateY(calc(-100% - 25px));
    }

    a {
      margin-bottom: 0;
    }

    @include tablets() {
      transform: none;
      opacity: 0;

      a {
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
</style>
