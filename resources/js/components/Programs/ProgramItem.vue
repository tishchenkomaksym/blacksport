<template>
  <article class="program-item">
    <h2>{{data.name}}</h2>
    <p :key="paragraph" v-for="paragraph in description">{{paragraph}}</p>
    <div class="glide program-item__images" ref="imagesSlider">
      <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
          <li
            :key="i"
            style="max-width: 192px"
            class="glide__slide"
            v-for="(image, i) in 4"
          >
            <!-- TODO Change to dynamic image -->
            <div
              :style="{backgroundImage: `url(https://loremflickr.com/80${i}/80${i}/sport)`}"
              class="program-item__images-item"
            />
          </li>
        </ul>
      </div>
    </div>
  </article>
</template>

<script>
import {computed, ref} from 'vue'
import useGlide from '../../hooks/useGlide'
import useParseText from '../../hooks/useParseText'

export default {
  name: 'ProgramItem',
  props: {
    data: Object,
  },
  setup({data}) {
    const images = computed(() => JSON.parse(data.images))
    const imagesSlider = ref(null)
    const glide = ref(null)
    const description = useParseText(data.description)

    useGlide(glide, imagesSlider, {
      perView: 4,
      gap: 16,
      bound: true,
      rewind: false,
      breakpoints: {
        768: {
          peek: {before: 40, after: 40},
        },
        450: {
          perView: 1,
          peek: {before: 16, after: 104},
        },
      },
    })

    return {
      description,
      images,
      imagesSlider,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.program-item {
  &__images {
    width: 100vw;
    margin: 0 0 0 #{-$spacing-md - $spacing-sm};
    transform: translateX($spacing);

    @include tablets() {
      margin: 0 0 0 #{-$spacing-lg * 2};
      transform: translateX($spacing-lg);
    }

    @include laptop() {
      width: 100%;
      margin: 0;
      transform: none;
    }

    &-item {
      padding-bottom: 100%;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
  }
}
</style>