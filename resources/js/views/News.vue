<template>
  <PageLayout>
    <template v-slot:title>
      {{t('news')}}
    </template>
    <div class="news">
      <div class="news__list">
        <NewsItem
          :key="article.id"
          :data="article"
          v-for="article in news"
        />
      </div>
    </div>
  </PageLayout>
</template>

<script>
import {computed, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import PageLayout from '../components/Layout/PageLayout'
import NewsItem from '../components/News/NewsItem'

export default {
  name: 'News',
  components: {NewsItem, PageLayout},
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
  @include laptop() {
    position: relative;
    overflow: hidden;
    @include page-height;
    @include container-gradients($bg-color);
  }

  &__list {
    display: grid;
    row-gap: $spacing;

    @include tablets() {
      column-gap: $spacing;
      grid-template-columns: repeat(2, 1fr);
    }

    @include laptop() {
      padding-top: $spacing-lg;
      height: 100%;
      overflow-y: auto;
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