<template>
  <section class="partners">
    <div class="partners__container">
      <h1>{{partnersText.name}}</h1>
      <p>{{partnersText.meta_description}}</p>
    </div>

    <div class="partners__list">
      <div class="partners__list-row partners__list-row--rectangle">
        <div
          :key="i"
          :style="{backgroundImage: `url(${imageSrc})`}"
          class="partners__list-item"
          v-for="(imageSrc, i) in rectangleImages"
        />
      </div>
      <div class="partners__list-row partners__list-row--square">
        <div
          :key="i"
          :style="{backgroundImage: `url(${imageSrc})`}"
          class="partners__list-item"
          v-for="(imageSrc, i) in squareImages"
        />
      </div>
    </div>
  </section>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import useImageStorage from '../../hooks/useImageStorage'

export default {
  name: 'Partners',
  setup() {
    const {state} = useStore()
    const partners = computed(() => state.pages.about.partners)
    const partnersText = computed(() => state.pages.about.texts.find(({page_key}) => page_key === 'partners') || {})
    const rectangleImages = computed(() => {
      const imageSrc = partners.value.reduce((imageSrc, partner) => {
        if (partner.image_type === 'rectangle') imageSrc.push(partner.image)
        return imageSrc
      }, [])
      return useImageStorage(imageSrc).value
    })
    const squareImages = computed(() => {
      const imageSrc = partners.value.reduce((imageSrc, partner) => {
        if (partner.image_type === 'square') imageSrc.push(partner.image)
        return imageSrc
      }, [])
      return useImageStorage(imageSrc).value
    })

    return {
      partnersText,
      partners,
      rectangleImages,
      squareImages,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.partners {
  margin-bottom: $spacing-md + $spacing-sm;

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

      &:not(:last-of-type) {
        margin-bottom: $spacing;
      }

      &--rectangle {
        flex-wrap: wrap-reverse;

        .partners__list-item {
          margin: $spacing-sm / 2;
          width: 164px;
          height: 72px;
        }
      }

      &--square {
        .partners__list-item {
          width: 104px;
          height: 104px;
          margin: $spacing-sm;

          @include tablets() {
            margin: 20px;
          }
        }
      }
    }

    &-item {
      background-size: auto;
      background-repeat: no-repeat;
      background-position: center;
      filter: grayscale(90%);
    }
  }
}
</style>