<template>
  <section class="achievements">
    <div class="achievements__container">
      <h1>{{achievementsText.name}}</h1>
      <p
        :key="i"
        v-for="(paragraph, i) in achievementsDescription"
      >
        {{paragraph}}
      </p>
    </div>

    <div class="achievements__list">
      <article
        :key="achievement.id"
        class="achievements__list-item"
        v-for="achievement in achievements"
      >
        <div
          @click="openVideoModal(getVideoId(achievement.video))"
          class="achievements__list-item__video"
          v-if="achievement.video && getVideoId(achievement.video)"
        >
          <img
            :src="getVideoThumbnail(achievement.video)"
            :alt="achievement.title"
            class="achievements__list-item__video-thumbnail"
          />
          <img class="achievements__list-item__video-icon" src="/img/youtube_social_icon_red.png" alt="Youtube" />
        </div>
        <img src="/img/branch.svg" alt="Branch" v-else />
        <h2>{{achievement.title}}</h2>
        <p>{{achievement.description}}</p>
      </article>
    </div>
  </section>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import useParseText from '../../hooks/useParseText'

export default {
  name: 'Achievements',
  setup() {
    const {commit, state} = useStore()
    const achievements = computed(() => state.pages.about.achievements)
    const achievementsText = computed(() => state.pages.about.texts.find(({page_key}) => page_key === 'made') || {})
    const achievementsDescription = computed(() => useParseText(achievementsText.value?.meta_description || '').value)

    const openVideoModal = videoUrl => {
      commit('common/setShownAchievement', videoUrl)
    }

    return {
      achievements,
      achievementsText,
      achievementsDescription,
      openVideoModal,
    }
  },
  methods: {
    getVideoThumbnail(url) {
      console.log(url)
      return `https://img.youtube.com/vi/${this.getVideoId(url)}/maxresdefault.jpg`
    },
    getVideoId(url) {
      const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/
      const match = url.match(regExp)
      return (match && match[7].length === 11) ? match[7] : false
    },
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.achievements {
  &__container {
    max-width: 880px;
    margin: 0 auto;
    text-align: center;
  }

  &__list {
    width: 100vw;
    margin: 0 0 0 -#{$spacing-md + $spacing-sm};
    transform: translateX($spacing);
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;

    @include tablets {
      width: initial;
      margin: initial;
      display: grid;
      transform: initial;
      grid-template-columns: repeat(2, 1fr);
      column-gap: $spacing-lg;
      row-gap: $spacing-md;
      overflow-x: initial;
    }

    @include laptop {
      grid-template-columns: repeat(3, 1fr);
    }

    @include large-desktop {
      grid-template-columns: repeat(4, 1fr);
    }
  }

  &__list-item {
    padding: $spacing;
    margin-right: $spacing;
    background-color: $smoke;
    text-align: center;

    &:first-of-type {
      margin-left: $spacing;
    }

    &:last-of-type {
      margin-right: $spacing;
    }

    @include tablets {
      padding: #{$spacing-md + $spacing-sm} $spacing;
      margin: initial;

      &:first-of-type,
      &:last-of-type {
        margin: initial;
      }
    }

    &__video {
      position: relative;
      cursor: pointer;

      &-thumbnail {
        width: 100%;
        min-width: 250px;
      }

      &-icon {
        width: 48px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        position: absolute;
      }
    }
  }
}
</style>