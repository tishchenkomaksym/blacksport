<template>
  <article class="program-item">
    <h2>{{data.name}}</h2>
    <p>{{data.description}}</p>
    <div class="glide program-item__images" ref="imagesSlider">
      <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
          <li
            :key="i"
            style="max-width: 192px"
            class="glide__slide"
            v-for="(image, i) in 10"
          >
            <!-- TODO Change to dynamic image -->
            <div
              :style="{backgroundImage: `url(https://loremflickr.com/1024/1024/sport_equipment)`}"
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

export default {
  name: 'ProgramItem',
  props: {
    data: Object,
  },
  setup({data}) {
    const images = computed(() => JSON.parse(data.images))
    const imagesSlider = ref(null)
    const glide = ref(null)

    useGlide(glide, imagesSlider, {
      gap: 16,
      bound: true,
      breakpoints: {
        450: {
          peek: {before: 16, after: 104},
        },
      },
    })

    return {
      images,
      imagesSlider,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

.program-item {
  &__images {
    width: 100vw;
    margin: 0 0 0 -32px;
    transform: translateX(16px);

    @include laptop() {
      width: 500px;
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