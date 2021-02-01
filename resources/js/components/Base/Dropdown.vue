<template>
  <div
    :class="{'select--opened': isOpen}"
    class="select"
    v-click-away="onClickAway"
  >
    <div
      @click="isOpen = !isOpen"
      class="select__label"
    >
      <span>{{modelValue ? modelValue.value : placeholder}}</span>
      <div>
        <span
          class="select__label__description"
          v-if="modelValue && modelValue.description"
        >{{modelValue.description}}</span>
        <svg
          :class="{'select__label__arrow--opened': isOpen}"
          class="select__label__arrow"
          viewBox="0 0 16 9"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M8.00019 8.80005C7.83201 8.80005 7.67155 8.72946 7.5579 8.60548L0.957898 1.40548C0.733982 1.16121 0.750484 0.781672 0.994756 0.557756C1.23903 0.333841 1.61857 0.350342 1.84248 0.594613L8.00019 7.31211L14.1579 0.594614C14.3818 0.350342 14.7614 0.33384 15.0056 0.557756C15.2499 0.781672 15.2664 1.16121 15.0425 1.40548L8.44249 8.60548C8.32884 8.72946 8.16838 8.80005 8.00019 8.80005Z"
          />
        </svg>
      </div>
    </div>

    <TransitionExpand>
      <div class="select__dropdown" v-if="isOpen">
        <input
          :placeholder="`${t('search')}...`"
          class="select__dropdown-search"
          v-model="searchValue"
          v-if="search"
        />
        <div class="select__dropdown__list">
          <div
            :key="option.id"
            @click="selectOption(option)"
            class="select__dropdown__list-item"
            v-for="option in options.filter(item => modelValue ? item.id !== modelValue.id : true)"
          >
            <span>{{option.value}}</span>
            <span
              class="select__dropdown__list-item__description"
              v-if="option.description"
            >{{option.description}}</span>
          </div>
        </div>
      </div>
    </TransitionExpand>
  </div>
</template>

<script>
import {ref, watch} from 'vue'
import {useI18n} from 'vue-i18n'

import TransitionExpand from './TransitionExpand'

export default {
  name: 'Dropdown',
  components: {TransitionExpand},
  props: {
    options: {
      type: Array,
      default: [],
    },
    modelValue: {
      type: Object,
    },
    placeholder: {
      type: String,
    },
    search: {
      type: Boolean,
      default: false,
    },
  },
  emits: [
    'update:modelValue',
    'search-change',
  ],
  setup({options, modelValue}, {emit}) {
    const {t} = useI18n()
    const isOpen = ref(false)
    const searchValue = ref('')
    const selectOption = option => {
      emit('update:modelValue', option)
      isOpen.value = false
    }

    const onClickAway = () => isOpen.value = false

    watch(searchValue, searchValue => emit('search-change', searchValue))

    return {
      t,
      isOpen,
      searchValue,
      selectOption,
      onClickAway,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.select {
  position: relative;

  &--opened {
    background-color: $bg-color;
  }

  &__label {
    padding: $spacing-sm 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: $text-color;
    cursor: pointer;

    > span {
      max-width: 90%;
      text-transform: uppercase;
      font-weight: 700;
      letter-spacing: 0.1em;

      @include tablets() {
        font-size: 18px;
      }
    }

    &__description {
      margin-right: $spacing-sm;
      color: $park;
      font-size: 14px;

      @include tablets() {
        font-size: $spacing;
      }
    }

    &__arrow {
      width: 14px;
      height: $spacing-sm;
      fill: $text-color;
      transition: transform 0.3s ease-in-out;

      @include tablets() {
        width: $spacing-md;
        height: 14px;
      }

      &--opened {
        transform: scaleY(-1);
      }
    }
  }

  &__dropdown {
    width: 100%;
    position: absolute;
    background-color: $bg-color;
    z-index: 1;

    &-search {
      width: 100%;
      margin: 0 0 $spacing-sm;
    }

    &__list {
      max-height: 200px;
      overflow-y: auto;

      &-item {
        margin: $spacing-sm 0;
        padding: $spacing-sm 0;
        cursor: pointer;
        color: $park;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: color 0.3s ease-in-out;

        > span:first-of-type {
          text-transform: uppercase;
          font-weight: 700;
          letter-spacing: 0.1em;

          @include tablets() {
            font-size: 18px;
          }
        }

        &:hover {
          color: $text-color;
        }

        &__description {
          font-size: 14px;
        }
      }
    }
  }
}
</style>
