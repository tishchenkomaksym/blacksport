<template>
  <div class="glide service-examples" ref="examplesSlider">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        <li
          :key="example.id"
          class="glide__slide service-examples__item"
          v-for="example in examples"
        >
          <ServiceExample :data="example" />
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import {ref} from 'vue'
import useGlide from '../../hooks/useGlide'
import ServiceExample from './ServiceExample'

export default {
  name: 'ServiceExamples',
  components: {ServiceExample},
  props: {
    examples: {
      type: Array,
      default: [],
      required: true,
    },
  },
  setup() {
    const glide = ref(null)
    const examplesSlider = ref(null)

    useGlide(glide, examplesSlider, {
      bound: true,
    })

    return {
      examplesSlider,
    }
  },
}
</script>

<style scoped lang="scss">
.service-examples {
  height: 100%;
}
</style>
