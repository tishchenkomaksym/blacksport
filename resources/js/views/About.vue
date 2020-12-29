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
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>

      <div class="about__container">
        <div class="about__mission">
          <img
            :src="i18n.locale === 'en' ? '/img/mission-en.svg' : '/img/mission-ru.svg'"
            alt="Mission"
          />
        </div>
      </div>

      <section class="about__ambassadors">
        <div class="about__container">
          <h1>Амбасадоры – носители наших ценностей</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <ul
          class="about__ambassadors-grid"
          :style="`--amount: ${about.ambassadors.length + 1}; --rows: ${ambassadorRows}`"
        >
          <li class="about__ambassadors-grid__item"
              :key="ambassador.id"
              v-for="ambassador in about.ambassadors"
          >
            <!-- TODO Change to dynamic image -->
            <div
              :style="{backgroundImage: `url(https://picsum.photos/200)`}"
              class="about__ambassadors-grid__item-content"
            />
          </li>
        </ul>
      </section>

      <section class="about__partners">
        <div class="about__container">
          <h1>Наши партнёры</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </section>
    </div>
  </PageLayout>
</template>

<script>
import {computed, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'

export default {
  name: 'About',
  components: {PageLayout},
  setup() {
    const i18n = useI18n()
    const {state, dispatch} = useStore()
    const about = computed(() => state.pages.about)
    const ambassadorRows = computed(() => {
      let rows = 0
      let ambassadorNumber = about.value.ambassadors.length
      while (ambassadorNumber > 0) {
        if (rows % 2 === 0) ambassadorNumber -= 4
        else ambassadorNumber -= 3
        rows += 1
      }
      return rows
    })

    watchEffect(() => {
      dispatch('pages/getAbout', i18n.locale.value)
    })

    return {
      i18n,
      about,
      ambassadorRows,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/breakpoints";

.about {
  &__container {
    max-width: 880px;
    margin: 0 auto;
  }

  &__images {
    display: flex;
    justify-content: center;
    margin-bottom: 24px;

    img {
      width: 50%;
      max-width: 440px;
      filter: drop-shadow(4px 4px 16px rgba(0, 0, 0, 0.08));

      @include tablets() {
        filter: drop-shadow(16px 16px 32px rgba(0, 0, 0, 0.08));
      }
    }
  }

  &__mission {
    margin: 24px 0;
    text-align: center;

    @include tablets() {
      margin: 48px 0 65px;
    }

    img {
      width: 100%;
      max-width: 600px;
    }
  }

  &__ambassadors {
    text-align: center;
    margin-bottom: 24px;

    @include laptop() {
      margin-bottom: 48px;
    }

    &-grid {
      width: 100vw;
      overflow-x: auto;
      --amount: 1;
      --counter: 1;
      --rows: 1;
      display: grid;
      grid-template-columns: repeat(var(--amount), 56px);
      grid-template-rows: repeat(2, 0.5fr 1fr) 0.5fr;
      column-gap: 16px;
      row-gap: 16px;
      list-style-type: none;
      margin: 0 0 0 -32px;
      transform: translateX(16px);
      padding: 8px 0;
      filter: drop-shadow(-8px 8px 16px rgba(0, 0, 0, 0.16));

      @include tablets() {
        $amount: 4;
        width: initial;
        margin: 0;
        padding: 0;
        column-gap: 32px;
        row-gap: 32px;
        grid-template-columns: repeat(#{$amount * 2}, 1fr);
        grid-template-rows: repeat(var(--rows), 0.5fr 1fr) 0.5fr;
        filter: drop-shadow(-16px 16px 32px rgba(0, 0, 0, 0.16));
        transform: initial;
      }

      &__item {
        grid-column: 1 / span 2;
        grid-row: var(--counter) / span 3;
        position: relative;

        @media screen and (max-width: 767px) {
          @for $i from 1 through 50 {
            &:nth-of-type(50n + #{$i}) {
              grid-column: #{$i} / span 2;
            }
          }

          &:nth-of-type(odd) {
            --counter: 1;
          }

          &:nth-of-type(even) {
            --counter: 3;
          }
        }

        @include tablets() {
          $amount: 4;
          // Calculate column index for rows consisting of 4 elements
          @for $i from 1 through 4 {
            &:nth-of-type(7n + #{$i}) {
              grid-column: #{$i + $i - 1} / span 2;
            }
          }

          // Calculate row index for odd rows
          @for $i from 1 through 20 {
            @if $i % 2 != 0 {
              @for $j from 1 through $amount {
                &:nth-of-type(#{($i - 2) * 7 + $j}) {
                  --counter: #{$i + $i - 1};
                }
              }
            }
          }

          &:nth-of-type(7n + 5) {
            grid-column: 2 / span 2;
          }
          &:nth-of-type(7n + 6) {
            grid-column: 4 / span 2;
          }
          &:nth-of-type(7n + 7) {
            grid-column: 6 / span 2;
          }

          &:nth-of-type(5) {
            --counter: 3;
          }
          &:nth-of-type(12) {
            --counter: 7;
          }
          &:nth-of-type(19) {
            --counter: 11;
          }

          &:nth-of-type(6) {
            --counter: 3;
          }
          &:nth-of-type(13) {
            --counter: 7;
          }
          &:nth-of-type(20) {
            --counter: 11;
          }

          &:nth-of-type(7) {
            --counter: 3;
          }
          &:nth-of-type(14) {
            --counter: 7;
          }
          &:nth-of-type(21) {
            --counter: 11;
          }
        }
      }

      &__item-content {
        width: 100%;
        height: 0;
        padding-bottom: calc(486 * 100% / 312);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        clip-path: polygon(50% 0, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
      }
    }
  }

  &__partners {
    text-align: center;
  }
}
</style>
