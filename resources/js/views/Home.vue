<template>
  <div class="home">
    <Hero/>
  </div>
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
.home {
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}
</style>
