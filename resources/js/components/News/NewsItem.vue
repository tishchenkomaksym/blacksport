<template>
  <article class="news-item">
    <div class="news-item__header">
      <router-link
        :to="articlePath"
        class="link link--smaller"
      >
        {{t('read')}}
      </router-link>
      <p class="description">{{dateCreated.day}} • {{dateCreated.time}}</p>
    </div>

    <router-link
      :style="{backgroundImage: `url(${images[0]})`}"
      :to="articlePath"
      class="news-item__image"
    />

    <h2><router-link :to="articlePath">{{data.title}}</router-link></h2>
    <p class="news-item__description">{{data.description}}</p>
  </article>
</template>

<script>
import {computed} from 'vue'
import {useI18n} from 'vue-i18n'
import {ROUTE_CONF} from '../../router'
import useImageStorage from '../../hooks/useImageStorage'

export default {
  name: 'NewsItem',
  props: {
    data: Object,
  },
  setup({data}) {
    const {t, locale} = useI18n()
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
    const images = useImageStorage(data.images)

    return {
      t,
      images,
      dateCreated,
      articlePath: computed(() => ({
        name: ROUTE_CONF.ARTICLE.name,
        params: {locale: locale.value, id: data.id},
      })),
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.news-item {
  &__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 5px;
  }

  &__image {
    display: block;
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
  }

  h2 a {
    color: $text-color;

    &:hover {
      color: $text-accent-color;
    }
  }
}
</style>