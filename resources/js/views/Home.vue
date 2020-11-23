<template>
  <img src="/img/blacksport_logo.svg" alt="">
  <div>I'm a HOME page</div>
  <ExampleComponent/>
</template>

<script>
import ExampleComponent from '../components/ExampleComponent'

export default {
  name: 'Home',
  components: {
    ExampleComponent,
  }
}
</script>
