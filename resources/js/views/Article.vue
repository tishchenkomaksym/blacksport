<template>
  <PageLayout
    :title="`${i18n.$t('defaults.news')} • ${article.title || ''}`"
  >
    <div class="article">
      <!-- TODO Change to original image -->
      <img
        :alt="article.title"
        class="article__image"
        src="https://loremflickr.com/800/1024/sport"
      />
      <div class="article__body">
        <h2>{{article.title}}</h2>
        <p>{{article.description}}</p>
      </div>
    </div>
  </PageLayout>
</template>

<script>
import {computed, onMounted, ref} from 'vue'
import {useRoute, useRouter} from 'vue-router'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'
import {ROUTE_CONF} from '../router'

export default {
  name: 'Article',
  components: {PageLayout},
  setup() {
    const {dispatch} = useStore()
    const route = useRoute()
    const router = useRouter()
    const i18n = useI18n()
    const article = ref({})
    const images = computed(() => article.value?.images ? JSON.parse(article.value.images) : [])

    onMounted(async () => {
      const data = await dispatch('news/getArticle', {id: route.params.id, locale: i18n.locale.value})
      if (!data) await router.replace({
        name: ROUTE_CONF.HOME.name,
        params: {locale: i18n.locale.value},
      })
      article.value = data
    })

    return {
      i18n,
      article,
      images,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/breakpoints";

.article {
  @include laptop() {
    display: grid;
    grid-template-columns: auto 1fr;
    column-gap: 40px;
  }

  &__image {
    width: 100%;

    @include laptop() {
      width: auto;
      max-width: 560px;
      max-height: calc((650 * 100vh) / 900);
    }
  }

  &__body {
    @include laptop() {
      max-height: calc((650 * 100vh) / 900);
      overflow-y: auto;

      &::before, &::after {
        width: calc(100% - 88px);
        max-width: calc(1440px - 88px);
        height: 40px;
        content: '';
        display: block;
        position: absolute;
      }

      &::before {
        top: 146px;
        background: linear-gradient(180deg, #000000 0%, rgba(0, 0, 0, 0) 100%);
      }

      &::after {
        top: calc(106px + (650 * 100vh) / 900);
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%);
      }
    }
  }
}
</style>