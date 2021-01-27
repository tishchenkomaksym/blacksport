<template>
  <div class="page-layout container" :style="{backgroundColor: bgColor}">
    <h1 class="page-heading">{{title}}</h1>
    <slot />
  </div>
</template>

<script>
import {computed, onMounted, onBeforeUnmount} from 'vue'
import {useStore} from 'vuex'

export default {
  name: 'PageLayout',
  props: {
    title: String,
    backgroundColor: String,
  },
  setup({backgroundColor}) {
    const {state, commit} = useStore()
    const bgColor = computed(() => state.common.backgroundColor)

    onMounted(() => {
      commit('common/setBackgroundColor', backgroundColor)
    })

    onBeforeUnmount(() => {
      commit('common/setBackgroundColor')
    })

    return {
      bgColor,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.page-layout {
  height: 100%;
  padding-top: 70px;
  box-sizing: border-box;

  &::after {
    content: '';
    display: block;
    height: $spacing-md;
  }

  @include tablets() {
    padding: #{$spacing-lg + $spacing-sm / 2} $spacing-lg 0;

    h1 {
      margin-bottom: 70px;
      text-align: center;
    }
  }

  .page-heading {
    display: none;

    @include tablets() {
      display: block;
    }
  }
}
</style>