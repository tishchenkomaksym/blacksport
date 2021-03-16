<template>
  <article class="news-item">
    <div class="news-item__header">
      <router-link
        :to="'/'"
        class="link link--smaller"
      >
        {{$t('read')}}
      </router-link>
      <p class="description" v-if="data.created_at">
        {{$d(new Date(data.created_at), 'date', localeType)}} • {{$d(new Date(data.created_at), 'time', localeType)}}
      </p>
    </div>

    <router-link
      :style="{backgroundImage: `url(${images[0]})`}"
      :to="articlePath"
      class="news-item__image"
    />

    <h2 class="news-item__title">
      <router-link
        :to="articlePath"
        class="basic"
      >
        {{data.title}}
      </router-link>
    </h2>
    <p class="news-item__description">{{data.description}}</p>
  </article>
</template>

<script>
import useImageStorage from '../../hooks/useImageStorage'
import {ROUTE_CONF} from '../../router'

export default {
  name: 'NewsItem',
  props: {
    data: Object,
  },
  computed: {
    localeType() {
      return this.$i18n.locale === 'ru' ? 'ru-RU' : this.$i18n.locale === 'en' ? 'en-US' : 'uk-UA'
    },
    articlePath() {
      return {
        name: ROUTE_CONF.ARTICLE.name,
        params: {locale: this.$i18n.locale, id: this.data.id},
      }
    },
  },
  setup(props) {
    return {
      images: useImageStorage(props.data.preview_image),
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

  &__title, &__description {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
  }

  &__title {
    -webkit-line-clamp: 2;
  }

  &__description {
    -webkit-line-clamp: 3;
  }
}
</style>