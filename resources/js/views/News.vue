<template>
  <PageLayout
    :title="i18n.$t('defaults.news')"
  >
    <div class="news">
      <NewsItem
        :key="article.id"
        :data="article"
        v-for="article in news"
      />
    </div>
  </PageLayout>
</template>

<script>
import {computed, onMounted} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'
import NewsItem from '../components/News/NewsItem'

export default {
  name: 'News',
  components: {NewsItem, PageLayout},
  setup() {
    const {dispatch, state} = useStore()
    const i18n = useI18n()
    const news = computed(() => state.pages.news)

    onMounted(() => {
      dispatch('pages/getNews', i18n.locale.value)
    })

    return {
      i18n,
      news,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/breakpoints";

.news {
  display: grid;
  row-gap: 16px;

  @include tablets() {
    column-gap: 16px;
    grid-template-columns: repeat(2, 1fr);
  }

  @include laptop() {
    max-height: calc((610 * 100vh) / 900);
    margin-top: -40px;
    padding-top: 40px;
    overflow-y: auto;
    row-gap: 40px;
    column-gap: 24px;
    grid-template-columns: repeat(3, 1fr);
    padding-right: 8px;

    &::before, &::after {
      width: calc(100% - 88px);
      max-width: calc(1440px - 88px);
      height: 40px;
      content: '';
      display: block;
      position: absolute;
    }

    &::before {
      top: 106px;
      background: linear-gradient(180deg, #000000 0%, rgba(0, 0, 0, 0) 100%);
    }

    &::after {
      top: calc(106px + (610 * 100vh) / 900);
      background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%);
    }
  }

  @include desktop() {
    grid-template-columns: repeat(4, 1fr);
    column-gap: 40px;
  }
}
</style>