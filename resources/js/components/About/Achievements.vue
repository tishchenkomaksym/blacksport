<template>
  <section class="achievements">
    <div class="achievements__container">
      <h1>{{achievementsText.name}}</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>

    <div class="achievements__list">
      <article
        :key="achievement.id"
        class="achievements__list-item"
        v-for="achievement in achievements.slice(0, 8)"
      >
        <img src="/img/branch.svg" alt="Branch">
        <h2>{{achievement.title}}</h2>
        <p>{{achievement.description}}</p>
      </article>
    </div>
  </section>
</template>

<script>
import {useStore} from 'vuex'
import {computed} from 'vue'

export default {
  name: 'Achievements',
  setup() {
    const {state} = useStore()
    const achievements = computed(() => state.pages.about.achievements)
    const achievementsText = computed(() => state.pages.about.texts.find(({page_key}) => page_key === 'made') || {})

    return {
      achievements,
      achievementsText,
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
    margin: 0 0 0 -32px;
    transform: translateX(16px);
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;

    @include tablets() {
      width: initial;
      margin: initial;
      display: grid;
      transform: initial;
      grid-template-columns: repeat(2, 1fr);
      column-gap: 40px;
      row-gap: 24px;
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
    padding: 16px;
    margin-right: 16px;
    background-color: $smoke;
    text-align: center;

    &:first-of-type {
      margin-left: 16px;
    }

    &:last-of-type {
      margin-right: 16px;
    }

    @include tablets() {
      padding: 32px 16px;
      margin: initial;

      &:first-of-type,
      &:last-of-type {
        margin: initial;
      }
    }
  }
}
</style>