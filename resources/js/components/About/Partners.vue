<template>
  <section class="partners">
    <div class="partners__container">
      <h1>{{partnersText.name}}</h1>
      <p>{{partnersText.meta_description}}</p>
    </div>

    <div class="partners__list">
      <div class="partners__list-row partners__list-row--rectangle">
        <div class="partners__list-item" style="background-image: url('/img/partners/minmol.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/autogallery.png')" />
      </div>
      <div class="partners__list-row partners__list-row--rectangle">
        <div class="partners__list-item" style="background-image: url('/img/partners/gallaprint.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/spacegravity.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/wedo.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/blagomay.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/kidev.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/knzs.png')" />
      </div>
      <div class="partners__list-row partners__list-row--square">
        <div class="partners__list-item" style="background-image: url('/img/partners/mosquito.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/voronov.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/box.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/fbu.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/sportclub.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/statusgroup.png')" />
      </div>
      <div class="partners__list-row partners__list-row--square">
        <div class="partners__list-item" style="background-image: url('/img/partners/cism.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/prestigebox.png')" />
        <div class="partners__list-item" style="background-image: url('/img/partners/chopchop.png')" />
      </div>
    </div>
  </section>
</template>

<script>
import {useStore} from 'vuex'
import {computed} from 'vue'

export default {
  name: 'Partners',
  setup() {
    const {state} = useStore()
    const partners = computed(() => state.pages.about.partners)
    const partnersText = computed(() => state.pages.about.texts.find(({page_key}) => page_key === 'partners') || {})

    return {
      partnersText,
      partners,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.partners {
  margin-bottom: 32px;

  @include laptop() {
    margin-bottom: 70px;
  }

  &__container {
    max-width: 880px;
    margin: 0 auto;
    text-align: center;
  }

  &__list {

    &-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;

      &--rectangle {
        div {
          width: 130px;
          height: 80px;
        }
      }

      &--square {
        div {
          width: 104px;
          height: 104px;
        }
      }
    }

    &-item {
      margin: 20px;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      filter: grayscale(90%);
    }
  }
}
</style>