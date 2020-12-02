<template>
  <Hero/>
</template>

<script>
import {ref} from 'vue'
import Hero from '../components/Home/Hero'

export default {
  name: 'Home',
  components: {Hero},
  setup() {
    const currentSlide = ref(0)

    return {
      currentSlide,
    }
  },
}
</script>

<style scoped lang="scss">
</style>
