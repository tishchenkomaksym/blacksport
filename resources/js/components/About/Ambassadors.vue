<template>
  <section class="ambassadors">
    <div class="ambassadors__container">
      <h1>{{ambassadorsText.name}}</h1>
      <p>{{ambassadorsText.meta_description}}</p>
    </div>

    <ul
      class="ambassadors__grid"
      :style="`--amount: ${ambassadors.length + 1}; --rows: ${ambassadorRows}`"
    >
      <li class="ambassadors__grid__item"
          :key="ambassador.id"
          v-for="(ambassador, i) in ambassadors"
      >
        <!-- TODO Change to dynamic image -->
        <div
          :style="{backgroundImage: `url(https://loremflickr.com/50${i % 9}/50${i % 9}/face)`}"
          class="ambassadors__grid__item-content"
        />
      </li>
    </ul>
  </section>
</template>

<script>
import {useStore} from 'vuex'
import {computed} from 'vue'

export default {
  name: 'Ambassadors',
  setup() {
    const {state} = useStore()
    const ambassadors = computed(() => state.pages.about.ambassadors)
    const ambassadorsText = computed(() => state.pages.about.texts.find(({page_key}) => page_key === 'ambassadors') || {})
    const ambassadorRows = computed(() => {
      let rows = 0
      let ambassadorNumber = ambassadors.value.length
      while (ambassadorNumber > 0) {
        if (rows % 2 === 0) ambassadorNumber -= 4
        else ambassadorNumber -= 3
        rows += 1
      }
      return rows
    })

    return {
      ambassadorsText,
      ambassadors,
      ambassadorRows,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

.ambassadors {
  margin-bottom: 32px;

  @include laptop() {
    margin-bottom: 70px;
  }

  &__container {
    max-width: 880px;
    margin: 0 auto;
    text-align: center;
  }

  &__grid {
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
    filter: drop-shadow(-8px 8px 16px rgba(0, 0, 0, 0.16)) grayscale(100%);

    @include tablets() {
      $amount: 4;
      width: initial;
      margin: 0;
      padding: 0;
      column-gap: 32px;
      row-gap: 32px;
      grid-template-columns: repeat(#{$amount * 2}, 1fr);
      grid-template-rows: repeat(var(--rows), 0.5fr 1fr) 0.5fr;
      filter: drop-shadow(-16px 16px 32px rgba(0, 0, 0, 0.16)) grayscale(100%);
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
</style>