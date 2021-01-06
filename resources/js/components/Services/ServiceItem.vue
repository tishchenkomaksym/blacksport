<template>
  <article class="service-item">
    <div class="service-item__info">
      <h2>{{data.name}}</h2>
      <p class="service-item__info-description">{{data.description}}</p>
      <div class="service-item__info-order">
        <Button link>{{i18n.$t('defaults.order')}}</Button>
      </div>
    </div>
    <p
      @click="examplesShown = !examplesShown"
      class="service-item__examples-button description"
    >
      {{i18n.$t(`defaults.${examplesShown ? 'hide' : 'serviceExamples'}`)}}
    </p>
  </article>
</template>

<script>
import {ref} from 'vue'
import {useI18n} from '../../i18nPlugin'
import Button from '../Base/Button'

export default {
  name: 'ServiceItem',
  components: {Button},
  props: {
    data: Object,
  },
  setup() {
    const i18n = useI18n()
    const examplesShown = ref(false)

    return {
      i18n,
      examplesShown,
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.service-item {
  background-color: $sole;
  position: relative;
  display: flex;
  justify-content: space-between;

  &__info {
    flex-grow: 1;
    padding: 16px 24px 16px 16px;
    display: grid;
    grid-template-rows: auto 1fr auto;

    h2 {
      margin: 0;
    }

    &-description {
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;

      @include phones() {
        -webkit-line-clamp: 4;
      }
    }

    &-order {
      text-align: right;
    }
  }

  &__examples-button {
    padding: 9px 12px;
    top: 0;
    right: 0;
    cursor: pointer;
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    background-color: $silt;
    text-transform: uppercase;
    line-height: 14px;
    text-align: center;
  }
}
</style>