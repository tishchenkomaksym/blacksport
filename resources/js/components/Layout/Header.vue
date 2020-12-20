<template>
  <header>
    <div class="toolbar container">
      <router-link
        :to="`/${i18n.locale.value}`"
        class="toolbar__logo"
      >
        <img src="/img/blacksport_logo.svg" alt="Blacksport">
      </router-link>
      <div class="toolbar__right-panel">
        <Basket />
        <router-link
          :to="`/${i18n.locale.value}`"
          class="link toolbar__home-link"
        >
          {{i18n.$t('defaults.home')}}
        </router-link>
        <button
          :class="{'toolbar__burger--opened': menuShown}"
          @click="toggleMenu"
          class="toolbar__burger"
        />
      </div>
    </div>
    <transition name="nav-complete">
      <nav class="container" v-if="menuShown">
        <router-link
          :data-link="link.name"
          :key="i"
          :to="link.path"
          class="link"
          v-for="(link, i) in links"
        >
          {{i18n.$t(`defaults.${link.name}`)}}
        </router-link>
      </nav>
    </transition>
  </header>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import {ROUTE_CONF} from '../../router'
import {useI18n} from '../../i18nPlugin'
import Basket from '../Products/Basket'

export default {
  name: 'Header',
  components: {Basket},
  setup() {
    const i18n = useI18n()
    const store = useStore()
    const links = computed(() => [
      {
        path: {
          name: ROUTE_CONF.HOME.name,
          params: {locale: i18n.locale.value},
        },
        name: 'home',
      },
      {
        path: {
          name: ROUTE_CONF.NEWS.name,
          params: {locale: i18n.locale.value},
        },
        name: 'news',
      },
      {
        path: {
          name: ROUTE_CONF.ABOUT.name,
          params: {locale: i18n.locale.value},
        },
        name: 'about',
      },
      {
        path: {
          name: ROUTE_CONF.SERVICES.name,
          params: {locale: i18n.locale.value},
        },
        name: 'services',
      },
      {
        path: {
          name: ROUTE_CONF.PRODUCTS.name,
          params: {locale: i18n.locale.value},
        },
        name: 'products',
      },
      {
        path: {
          name: ROUTE_CONF.PROGRAMS.name,
          params: {locale: i18n.locale.value},
        },
        name: 'programs',
      },
      {
        path: {
          name: ROUTE_CONF.CONTACTS.name,
          params: {locale: i18n.locale.value},
        },
        name: 'contacts',
      },
    ])

    return {
      i18n,
      menuShown: computed(() => store.state.common.menuShown),
      toggleMenu: () => store.commit('common/toggleMenu'),
      links,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

header {
  width: 100vw;
  position: absolute;
  z-index: 1;
}

.toolbar {
  padding: 20px 16px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;

  @include tablets() {
    padding: 48px 48px 0;
  }

  &__logo {
    opacity: 0.2;

    img {
      height: 24px;

      @include tablets() {
        height: 32px;
      }
    }
  }

  &__right-panel {
    display: grid;
    grid-template-columns: auto auto;
    align-items: center;
    column-gap: 10px;

    @include tablets() {
      grid-template-columns: repeat(3, auto);
    }
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
  height: calc(100vh - 50px);
  padding: 35px 24px 60px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow-y: auto;

  @include tablets() {
    align-items: flex-end;
    height: calc(100vh - 90px);
    padding: 48px 48px 60px;
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

.nav-complete {
  &-enter-active,
  &-leave-active {
    transition: transform 0.5s ease-in-out;

    a {
      transition: margin-bottom 0.5s ease-in-out;
    }

    @include tablets() {
      transition: none;

      a {
        transition: none;
      }
    }
  }

  &-enter-from,
  &-leave-to {
    transform: translateY(calc(-100% + 300px));

    a {
      margin-bottom: 0;
    }

    @include tablets() {
      transform: none;

      a {
        margin-bottom: 28px;
      }
    }
  }
}
</style>
