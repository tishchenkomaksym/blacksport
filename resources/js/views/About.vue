<template>
  <PageLayout
    :title="i18n.$t('defaults.about')"
    background-color="park"
  >
    <div class="about">
      <div class="about__container">
        <div class="about__images">
          <img src="/img/about/about-1.png" alt="Snowboarding">
          <img src="/img/about/about-2.png" class="about__img2" alt="Man playing football">
        </div>
        <h1>{{i18n.$t('defaults.about')}}</h1>
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
<!--        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
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
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'
import Achievements from '../components/About/Achievements'
import Partners from '../components/About/Partners'
import Ambassadors from '../components/About/Ambassadors'

export default {
  name: 'About',
  components: {Ambassadors, Partners, Achievements, PageLayout},
  setup() {
    const i18n = useI18n()
    const {dispatch} = useStore()
    const missionImageSrc = computed(() => i18n.locale.value === 'en' ? '/img/mission-en.svg' : '/img/mission-ru.svg')

    watchEffect(() => {
      dispatch('pages/getAbout', i18n.locale.value)
    })

    return {
      i18n,
      missionImageSrc,
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
    justify-content: center;
    margin-bottom: $spacing-md;

    img {
      width: 50%;
      max-width: 440px;
      filter: drop-shadow($spacing-sm / 2 $spacing-sm / 2 $spacing rgba($bg-color, 0.08));

      @include tablets() {
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
