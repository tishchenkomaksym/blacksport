<template>
  <PageLayout>
    <template v-slot:title>
      <router-link
        :to="newsLink"
        class="basic"
      >
        {{t('news')}}
      </router-link> <span v-if="article.title">• {{article.title}}</span>
    </template>
    <div class="article">
      <div
        :class="{'article__images--disabled': width >= 1024}"
        class="glide article__images"
        ref="imageSlider"
      >
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li
              :key="i"
              class="glide__slide"
              v-for="(image, i) in images"
            >
              <div
                :style="{backgroundImage: `url(${image})`}"
                class="article__images-item"
              />
            </li>
          </ul>
        </div>
      </div>

      <div class="article__main">
        <div
          @wheel="onTextWheel"
          @scroll="onTextScroll"
          class="article__main__content"
          ref="textContainer"
        >
          <h2>{{article.title}}</h2>
          <p
            :key="i"
            v-for="(paragraph, i) in articleText"
          >
            {{paragraph}}
          </p>
        </div>
      </div>
    </div>
  </PageLayout>
</template>

<script>
import {computed, ref, watch} from 'vue'
import {useRoute, useRouter} from 'vue-router'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import useImageStorage from '../hooks/useImageStorage'
import useParseText from '../hooks/useParseText'
import useGlide from '../hooks/useGlide'
import useWindowSize from '../hooks/useWindowSize'
import PageLayout from '../components/Layout/PageLayout'
import {ROUTE_CONF} from '../router'
import {scaleValue} from '../helpers'

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
      breakpoints: {
        768: {
          perView: 2,
        },
        544: {
          perView: 1,
        },
      },
    })
    const images = computed(() => useImageStorage(article.value?.images || '').value)

    const description = computed(() => article.value?.description || '')
    const articleText = computed(() => useParseText(description.value).value)
    /** @type import('vue').Ref<HTMLDivElement> */
    const textContainer = ref(null)
    const wheelAccum = ref(0) // Used for Wheel event when the text container isn't scrollable
    const isScrolling = ref(0) // Used for tracking Scroll event. Wheel event isn't fired in this case

    watch(images, () => glideRef.refreshGlide())

    watch(locale, async locale => {
      try {
        const data = await dispatch('news/getArticle', {id: route.params.id, locale})
        if (!data) await router.replace({
          name: ROUTE_CONF.PRODUCTS.name,
          params: {locale},
        })
        article.value = data
      } catch (err) {
        console.error(err)
      }
    }, {immediate: true})

    watch(article, article => {
      if (article?.title) document.title = `Blacksport | ${article.title}`
    })

    /**
     * @description Fired when the text container isn't scrollable
     * @param event {WheelEvent}
    */
    const onTextWheel = event => {
      const isScrollable = textContainer.value.scrollHeight > textContainer.value.offsetHeight
      if (width.value < 1024 || wheelAccum.value + Math.sign(event.deltaY) < 0 || isScrollable) return

      wheelAccum.value += Math.sign(event.deltaY)
    }

    /**
     * @description Fired when the text container is scrollable. Wheel event won't fire in this case
     */
    const onTextScroll = () => {
      if (width.value < 1024) return
      // Fire scroll event only when scroll is finished
      clearTimeout(isScrolling.value)
      isScrolling.value = setTimeout(() => {
        const scrollHeight = textContainer.value.scrollHeight - textContainer.value.offsetHeight
        const currentScroll = textContainer.value.scrollTop
        const imageIndex = scaleValue(currentScroll, [0, scrollHeight], [0, images.value.length - 1])
        glide.value.go(`=${imageIndex}`)
      }, 66)
    }

    watch(wheelAccum, (scrollAccum, prevScrollAccum) => {
      if (scrollAccum % 4 === 0) glide.value.go(scrollAccum > prevScrollAccum ? '>' : '<')
    })

    return {
      t,
      images,
      imageSlider,
      article,
      articleText,
      textContainer,
      onTextWheel,
      onTextScroll,
      width,
      newsLink: computed(() => ({
        name: ROUTE_CONF.NEWS.name,
        params: {locale: locale.value},
      })),
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/breakpoints";
@import "../assets/scss/variables";
@import "../assets/scss/page-helpers";

.article {
  @include laptop() {
    display: grid;
    grid-template-columns: 560px 1fr;
    column-gap: $spacing-lg;
    @include page-height;
  }

  &__images {
    &--disabled {
      pointer-events: none;
    }

    &-item {
      width: 100%;
      padding-bottom: 100%;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;

      @include laptop() {
        padding-bottom: $page-height;
      }
    }
  }

  &__main {
    overflow: hidden;
    position: relative;
    @include container-gradients($bg-color);

    @include laptop() {
      &__content {
        height: 100%;
        overflow-y: auto;
      }
    }
  }
}
</style>