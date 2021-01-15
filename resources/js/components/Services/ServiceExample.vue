<template>
  <div
    :style="{backgroundImage: `url(https://loremflickr.com/50${data.id % 9}/50${data.id % 9}/sport_equipment)`}"
    class="service-example"
  />
</template>

<script>
import {computed} from 'vue'

export default {
  name: 'ServiceExample',
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
  setup({data}) {
    const image = computed(() => JSON.parse(data.media)[0])

    return {
      image,
    }
  },
}
</script>

<style scoped lang="scss">
.service-example {
  height: 0;
  padding-bottom: 100%;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  cursor: pointer;
}
</style>