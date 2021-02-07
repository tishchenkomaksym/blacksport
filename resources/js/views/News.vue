<template>
  <PageLayout background-color="bgColor">
    <template v-slot:title>
      {{t('news')}}
    </template>
    <GradientContainer color="bgColor" class="news">
      <NewsItem
        :key="article.id"
        :data="article"
        v-for="article in news"
      />
    </GradientContainer>
  </PageLayout>
</template>

<script>
import {computed, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'

import PageLayout from '../components/Layout/PageLayout'
import NewsItem from '../components/News/NewsItem'
import GradientContainer from '../components/Layout/GradientContainer'

export default {
  name: 'News',
  components: {GradientContainer, NewsItem, PageLayout},
  setup() {
    const {dispatch, state} = useStore()
    const {t, locale} = useI18n()
    const news = computed(() => state.news.news)

    watchEffect(() => {
      dispatch('news/getNews', locale.value)
    })

    return {
      t,
      news,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";
@import "../assets/scss/page-helpers";

.news {
  @include tablets() {
    overflow-y: auto;
  }

  @include mobile-landscape() {
    height: calc(#{$page-height} - 49px);
  }

  @media screen and (min-width: 768px) and (min-height: 768px) {
    @include page-height;
  }

  display: grid;
  row-gap: $spacing;

  @include tablets() {
    column-gap: $spacing;
    grid-template-columns: repeat(2, 1fr);
  }

  @include laptop() {
    row-gap: $spacing-lg;
    column-gap: $spacing-md;
    grid-template-columns: repeat(3, 1fr);
  }

  @include desktop() {
    grid-template-columns: repeat(4, 1fr);
    column-gap: $spacing-lg;
  }
}
</style>