<template>
  <div
    :style="{backgroundImage: `url(${image})`}"
    class="service-example"
  />
</template>

<script>
import useImageStorage from '../../hooks/useImageStorage'

export default {
  name: 'ServiceExample',
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const image = useImageStorage(JSON.parse(props.data.media)[0], true)

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