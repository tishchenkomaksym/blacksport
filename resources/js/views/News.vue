<template>
  <PageLayout
    :title="i18n.$t('defaults.news')"
  >
    <div class="news">
      <div class="news__list">
        <NewsItem
          :key="article.id"
          :data="article"
          v-for="article in news"
        />
      </div>
      <div class="news__end" />
    </div>
  </PageLayout>
</template>

<script>
import {computed, watchEffect} from 'vue'
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
    const news = computed(() => state.news.news)

    watchEffect(() => {
      dispatch('news/getNews', i18n.locale.value)
    })

    return {
      i18n,
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
  @include laptop() {
    margin-top: -$spacing-lg;
    padding-right: $spacing-sm;
    padding-top: $spacing-lg;
    overflow-y: auto;
    @include page-height;
    @include container-gradients($bg-color);

    &__end {
      height: $gradient-height;
    }
  }

  &__list {
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
}
</style>