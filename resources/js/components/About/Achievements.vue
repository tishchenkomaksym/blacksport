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
        <img src="/img/branch.svg" alt="Branch">
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
    const {state} = useStore()
    const achievements = computed(() => state.pages.about.achievements)
    const achievementsText = computed(() => state.pages.about.texts.find(({page_key}) => page_key === 'made') || {})
    const achievementsDescription = computed(() => useParseText(achievementsText.value?.meta_description || '').value)

    return {
      achievements,
      achievementsText,
      achievementsDescription,
    }
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

    @include tablets() {
      width: initial;
      margin: initial;
      display: grid;
      transform: initial;
      grid-template-columns: repeat(2, 1fr);
      column-gap: $spacing-lg;
      row-gap: $spacing-md;
      overflow-x: initial;
    }

    @include laptop() {
      grid-template-columns: repeat(3, 1fr);
    }

    @include large-desktop() {
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

    @include tablets() {
      padding: #{$spacing-md + $spacing-sm} $spacing;
      margin: initial;

      &:first-of-type,
      &:last-of-type {
        margin: initial;
      }
    }
  }
}
</style>