<template>
  <PageLayout background-color="park">
    <template v-slot:title>
      {{$t('about')}}
    </template>
    <div class="about">
      <div class="about__container">
        <div class="about__images">
          <img src="/img/about/about-1.png" alt="Snowboarding">
          <img src="/img/about/about-2.png" class="about__img2" alt="Man playing football">
        </div>
        <h1>{{$t('about')}}</h1>
        <p :key="i" v-for="(paragraph, i) in aboutParagraphs">{{paragraph}}</p>
      </div>

      <div class="about__container">
        <div class="about__mission">
          <img
            :src="missionImageSrc"
            alt="Mission"
          />
        </div>
      </div>

      <Ambassadors />
      <Partners />
      <Achievements />
    </div>
  </PageLayout>
</template>

<script>
import {computed, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import useParseText from '../hooks/useParseText'

import PageLayout from '../components/Layout/PageLayout'
import Achievements from '../components/About/Achievements'
import Partners from '../components/About/Partners'
import Ambassadors from '../components/About/Ambassadors'

export default {
  name: 'About',
  components: {Ambassadors, Partners, Achievements, PageLayout},
  setup() {
    const {locale} = useI18n()
    const {dispatch, state} = useStore()
    const missionImageSrc = computed(() => locale.value === 'en' ? '/img/mission-en.svg' : '/img/mission-ru.svg')
    const aboutText = computed(() => state.pages.about.texts.find(({page_key}) => page_key === 'about') || {})
    const aboutParagraphs = computed(() => useParseText(aboutText.value.meta_description || '').value)

    watchEffect(() => {
      dispatch('pages/getAbout', locale.value)
    })

    return {
      missionImageSrc,
      aboutParagraphs,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/breakpoints";
@import "../assets/scss/variables";

.about {
  &__container {
    max-width: 880px;
    margin: 0 auto;
  }

  &__images {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: $spacing-md;

    @include tablets() {
      justify-content: center;
    }

    img {
      width: calc((136 * 100%) / 288);
      max-width: 440px;
      filter: drop-shadow($spacing-sm / 2 $spacing-sm / 2 $spacing rgba($bg-color, 0.08));

      @include tablets() {
        width: 50%;
        filter: drop-shadow($spacing $spacing #{$spacing-sm + $spacing-md} rgba($bg-color, 0.08));
      }
    }
  }

  &__mission {
    margin: $spacing-md 0;
    text-align: center;

    @include tablets() {
      margin: #{$spacing-sm + $spacing-lg} 0 65px;
    }

    img {
      width: 100%;
      max-width: 600px;
    }
  }
}
</style>
