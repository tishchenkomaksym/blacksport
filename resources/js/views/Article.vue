<template>
  <PageLayout
    :title="`${t('news')} • ${article.title || ''}`"
  >
    <div class="article">
      <div class="glide article__images" ref="imageSlider" v-show="width < 1024">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li
              :key="i"
              class="glide__slide"
              v-for="(image, i) in images"
            >
              <img
                :src="image"
                :alt="article.title"
                class="article__image"
              />
            </li>
          </ul>
        </div>
      </div>
      <img
        :alt="article.title"
        :src="images[0]"
        class="article__image"
        v-show="width >= 1024"
      />

      <div class="article__body" ref="textContainer">
        <h2>{{article.title}}</h2>
        <p
          :key="i"
          v-for="(paragraph, i) in articleText"
        >
          {{paragraph}}
        </p>
      </div>
    </div>
  </PageLayout>
</template>

<script>
import {computed, onBeforeUnmount, onMounted, ref, watch, watchEffect} from 'vue'
import {useRoute, useRouter} from 'vue-router'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import useImageStorage from '../hooks/useImageStorage'
import useParseText from '../hooks/useParseText'
import useGlide from '../hooks/useGlide'
import useWindowSize from '../hooks/useWindowSize'
import PageLayout from '../components/Layout/PageLayout'
import {ROUTE_CONF} from '../router'

export default {
  name: 'Article',
  components: {PageLayout},
  setup() {
    const {dispatch} = useStore()
    const route = useRoute()
    const router = useRouter()
    const {t, locale} = useI18n()
    const {width} = useWindowSize()

    const article = ref({})

    const glide = ref(null)
    const imageSlider = ref(null)
    const glideRef = useGlide(glide, imageSlider, {
      bound: true,
      rewind: false,
    })
    const images = computed(() => useImageStorage(article.value?.images || '').value)

    const description = computed(() => article.value?.description || '')
    const articleText = computed(() => useParseText(description.value).value)
    const textContainer = ref(null)

    watch(images, () => glideRef.refreshGlide())

    watchEffect(async () => {
      try {
        const data = await dispatch('news/getArticle', {id: route.params.id, locale: locale.value})
        if (!data) await router.replace({
          name: ROUTE_CONF.HOME.name,
          params: {locale: locale.value},
        })
        article.value = data
      } catch (err) {
        console.error(err)
      }
    })

    // TODO Image switch logic on scroll
    onMounted(() => {

    })

    onBeforeUnmount(() => {

    })

    return {
      t,
      images,
      imageSlider,
      article,
      articleText,
      textContainer,
      width,
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