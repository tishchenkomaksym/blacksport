<template>
  <section class="news">
    <PrevSectionButton
      :title="t('about')"
      @click="$emit('switch-slide', 'about')"
    />
    <div class="news__content">
      <div class="news__heading container">
        <h2>{{t('news')}}</h2>
        <router-link
          :to="newsPath"
          class="link subtitle"
        >
          {{t('allNews')}}
        </router-link>
      </div>
      <div class="glide news__list" ref="newsSlider">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li
              :key="newsItem.id"
              class="glide__slide"
              :style="{maxWidth: '310px'}"
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
import {computed, ref} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import {ROUTE_CONF} from '../../router'
import useGlide from '../../hooks/useGlide'
import NewsItem from '../News/NewsItem'
import PrevSectionButton from './PrevSectionButton'

export default {
  name: 'News',
  components: {PrevSectionButton, NewsItem},
  setup() {
    const {state} = useStore()
    const {t, locale} = useI18n()
    const glide = ref(null)
    const newsSlider = ref(null)
    const news = computed(() => state.home.homeData.news)

    useGlide(glide, newsSlider, {
      perView: 4,
      gap: 40,
      bound: true,
      rewind: false,
      peek: {before: 40, after: 0},
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
          peek: {before: 40, after: 0},
        },
        450: {
          perView: 1,
          gap: 16,
          peek: {before: 16, after: 104},
        },
      },
    })

    return {
      news,
      t,
      newsSlider,
      newsPath: computed(() => ({
        name: ROUTE_CONF.NEWS.name,
        params: {locale: locale.value},
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

    @include landscape() {
      margin-top: 8px;
      height: 65vh;
      overflow-y: auto;
    }

    @include laptop() {
      margin-top: 40px;
      height: 84vh;
    }
  }

  .container {
    @include tablets() {
      padding: 0 40px;
    }

    @include laptop() {
      padding: 40px 40px 0;
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
    @include laptop() {
      max-width: 1440px;
      margin: 40px auto 0;
    }
  }
}
</style>