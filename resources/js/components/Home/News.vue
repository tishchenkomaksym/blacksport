<template>
  <section class="news">
    <PrevSectionButton
      :title="i18n.$t('defaults.about')"
      @click="$emit('switch-slide', 'about')"
    />
    <div class="news__content">
      <div class="news__heading container">
        <h2>{{i18n.$t('defaults.news')}}</h2>
        <router-link
          :to="newsPath"
          class="link subtitle"
        >
          {{i18n.$t('defaults.allNews')}}
        </router-link>
      </div>
      <div class="glide news__list" ref="newsSlider">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li
              :key="newsItem.id"
              class="glide__slide"
              :style="{maxWidth: '306px'}"
              v-for="newsItem in news"
            >
              <NewsItem :data="newsItem" />
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {computed, nextTick, onMounted, ref, watch} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../../i18nPlugin'
import {ROUTE_CONF} from '../../router'
import Glide from '@glidejs/glide'
import NewsItem from '../News/NewsItem'
import PrevSectionButton from './PrevSectionButton'

export default {
  name: 'News',
  components: {PrevSectionButton, NewsItem},
  setup() {
    const {state} = useStore()
    const i18n = useI18n()
    const glide = ref(null)
    const newsSlider = ref(null)
    const news = computed(() => state.home.homeData.news)

    const mountGlide = () => {
      glide.value = new Glide(newsSlider.value, {
        perView: 4,
        gap: 40,
        bound: true,
        breakpoints: {
          1439: {
            perView: 3,
            gap: 16,
          },
          968: {
            perView: 2,
          },
          768: {
            perView: 1,
            gap: 16,
            peek: {before: 0, after: 104},
          },
        },
      })
      .on('resize', refreshGlide)
      glide.value.mount()
    }

    const destroyGlide = () => {
      if (glide.value) {
        glide.value.destroy()
        glide.value = null
      }
    }

    const refreshGlide = async () => {
      destroyGlide()
      await nextTick()
      mountGlide()
    }

    onMounted(() => {
      mountGlide()
    })

    watch(() => news.value, () => {
      if (newsSlider.value) {
        refreshGlide()
      }
    })

    return {
      news,
      i18n,
      newsSlider,
      newsPath: computed(() => ({
        name: ROUTE_CONF.NEWS.name,
        params: {locale: i18n.locale.value},
      })),
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.news {
  height: 100%;
  background-color: $park;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;

  &__content {
    margin-top: 16px;
    height: 77vh;
    background-color: $bg-color;
    box-sizing: border-box;

    @include laptop() {
      margin-top: 40px;
      height: 84vh;
    }
  }

  .container {
    @include laptop() {
      padding: 40px 48px 0;
    }
  }

  &__heading {
    display: flex;
    align-items: center;
    justify-content: space-between;

    h2 {
      @include laptop() {
        margin: 0;
        font-size: 36px;
        font-weight: 700;
      }
    }
  }

  &__list {
    padding: 0 0 0 16px;

    @include laptop() {
      max-width: 1440px;
      margin: 40px auto 0;
      padding: 0 48px;
    }
  }
}
</style>