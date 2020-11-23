<template>
  <main>
    <slot/>
  </main>
  <Footer/>
</template>

<script>
import Footer from './Footer'

export default {
  name: 'Layout',
  components: {Footer},
}
</script>

<style scoped lang="scss">
</style>
