<template>
  <div class="page-layout container">
    <h1 class="page-heading">
      <slot name="title"/>
    </h1>
    <slot/>
  </div>
</template>

<script>
import {onBeforeUnmount, watchEffect} from 'vue'
import {useStore} from 'vuex'

export default {
  name: 'PageLayout',
  props: {
    title: String,
    backgroundColor: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    const {commit} = useStore()

    watchEffect(() => {
      commit('common/setBackgroundColor', props.backgroundColor)
    })

    onBeforeUnmount(() => {
      commit('common/setBackgroundColor')
    })
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.page-layout {
  min-height: 100vh;
  padding-top: 70px;
  box-sizing: border-box;

  &::after {
    content: '';
    display: block;
    height: $spacing-md;
  }

  @include tablets() {
    padding: #{$spacing-lg + $spacing-sm / 2} $spacing-lg 0;
  }

  .page-heading {
    display: none;

    @include tablets() {
      text-align: center;
      line-height: 135%;
      max-width: 42.5%;
      display: block;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    @include big-phones-landscape() {
      margin: 5px auto 40px;
    }

    @include phones-tablets() {
      margin: 5px auto 70px;
    }

    @include laptop() {
      max-width: 55%;
    }

    @include desktop() {
      max-width: 60%;
    }

    @include large-desktop() {
      max-width: 65%;
    }

    @media screen and (min-width: 1500px) {
      max-width: 75%;
    }

    @media screen and (min-width: 1600px) {
      max-width: 80%;
    }

    @media screen and (min-width: 1700px) {
      max-width: 90%;
    }

    @media screen and (min-width: 1800px) {
      max-width: 100%;
    }
  }
}
</style>