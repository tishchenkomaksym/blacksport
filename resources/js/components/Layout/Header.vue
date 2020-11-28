<template>
  <header>
    <div class="toolbar">
      <router-link
        :to="`/${i18n.locale.value}`"
        class="toolbar__logo"
      >
        <img src="/img/blacksport_logo.svg" alt="Blacksport">
      </router-link>
      <div>
        <button @click="toggleMenu">Open menu</button>
      </div>
    </div>
    <nav v-if="menuShown">
      <router-link
        :key="i"
        :to="link.path"
        v-for="(link, i) in links"
      >
        {{i18n.$t(`defaults.${link.name}`)}}
      </router-link>
    </nav>
  </header>
</template>

<script>
import {computed, ref} from 'vue'
import {ROUTE_CONF} from '../../router'
import {useI18n} from '../../i18nPlugin'

export default {
  name: 'Header',
  setup() {
    const i18n = useI18n()
    const menuShown = ref(false)
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
    ])

    const toggleMenu = () => menuShown.value = !menuShown.value

    return {
      i18n,
      menuShown,
      toggleMenu,
      links,
    }
  },
}
</script>

<style scoped lang="scss">
header {
  position: absolute;
  background-color: rgba(white, 0.2);
}

.toolbar {
  width: 100vw;
  padding: 48px 48px 0;
  box-sizing: border-box;
  display: flex;
  justify-content: space-between;

  &__logo {
    img {
      height: 36px;
    }
  }
}
</style>
