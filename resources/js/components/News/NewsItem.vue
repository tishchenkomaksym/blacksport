<template>
  <article class="news-item">
    <div class="news-item__header">
      <!-- TODO add route to article -->
      <router-link
        to="/"
        class="link link--smaller"
        style="transition-property: none"
      >
        {{i18n.$t('defaults.read')}}
      </router-link>
      <p class="description">{{dateCreated.day}} • {{dateCreated.time}}</p>
    </div>

    <!-- TODO change to dynamic image -->
    <div
      :style="{backgroundImage: `url(${'https://picsum.photos/1024'})`}"
      class="news-item__image"
    />

    <h2>{{data.title}}</h2>
    <p class="news-item__description">{{data.description}}</p>
  </article>
</template>

<script>
import {computed} from 'vue'
import {useI18n} from '../../i18nPlugin'

export default {
  name: 'NewsItem',
  props: {
    data: Object,
  },
  setup({data}) {
    const i18n = useI18n()
    const locale = computed(() => i18n.locale.value)
    const dateCreated = computed(() => {
      const date = new Date(data.created_at)
      const locales = locale.value === 'ru' ? 'ru-RU' : locale.value === 'en' ? 'en-US' : 'uk-UA'
      const day = new Intl.DateTimeFormat(
        locales,
        {dateStyle: 'long'},
      ).format(date)
      const time = new Intl.DateTimeFormat(
        locales,
        {timeStyle: 'short'},
      ).format(date)
      return {
        day,
        time,
      }
    })
    const image = computed(() => JSON.parse(data.images)[0])

    return {
      i18n,
      image,
      dateCreated,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

.news-item {
  &__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 5px;
  }

  &__image {
    width: 100%;
    padding-bottom: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  &__description {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;

    @include desktop() {
      font-size: 16px;
      line-height: 22px;
    }
  }
}
</style>