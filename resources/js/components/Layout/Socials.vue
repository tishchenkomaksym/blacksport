<template>
  <transition appear name="slide">
    <div class="socials" v-if="!isHidden">
      <a
        :href="socialLinks.find(link => link.includes('facebook') || link.includes('fb'))"
        target="_blank"
        title="Facebook"
      >
        <svg width="14" height="26" viewBox="0 0 15 28" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M14.2078 0.672235L10.7497 0.666687C6.86467 0.666687 4.35399 3.24255 4.35399 7.22939V10.2552H0.877061C0.576613 10.2552 0.333313 10.4988 0.333313 10.7993V15.1834C0.333313 15.4838 0.57689 15.7271 0.877061 15.7271H4.35399V26.7896C4.35399 27.0901 4.59729 27.3334 4.89774 27.3334H9.43415C9.7346 27.3334 9.9779 27.0898 9.9779 26.7896V15.7271H14.0432C14.3437 15.7271 14.587 15.4838 14.587 15.1834L14.5887 10.7993C14.5887 10.655 14.5312 10.5168 14.4294 10.4148C14.3276 10.3127 14.1889 10.2552 14.0446 10.2552H9.9779V7.69019C9.9779 6.45732 10.2717 5.83146 11.8777 5.83146L14.2072 5.83063C14.5074 5.83063 14.7507 5.58705 14.7507 5.28688V1.21598C14.7507 0.91609 14.5077 0.67279 14.2078 0.672235Z"
          />
        </svg>
      </a>
      <a
        :href="socialLinks.find(link => link.includes('instagram'))"
        target="_blank"
        title="Instagram"
      >
        <svg width="26" height="26" viewBox="7 7 26 26" xmlns="http://www.w3.org/2000/svg">
          <path d="M25.3892 6.66669H14.6108C10.2304 6.66669 6.66669 10.2304 6.66669 14.6108V25.3892C6.66669 29.7696 10.2304 33.3334 14.6108 33.3334H25.3892C29.7696 33.3334 33.3334 29.7696 33.3334 25.3892V14.6108C33.3333 10.2304 29.7696 6.66669 25.3892 6.66669ZM30.6507 25.3892C30.6507 28.295 28.295 30.6507 25.3892 30.6507H14.6108C11.705 30.6507 9.34935 28.295 9.34935 25.3892V14.6108C9.34935 11.705 11.705 9.34935 14.6108 9.34935H25.3892C28.295 9.34935 30.6507 11.705 30.6507 14.6108V25.3892Z"/>
          <path d="M20 13.103C16.197 13.103 13.103 16.197 13.103 19.9999C13.103 23.8029 16.197 26.8969 20 26.8969C23.803 26.8969 26.8969 23.8029 26.8969 19.9999C26.8969 16.1969 23.803 13.103 20 13.103ZM20 24.2143C17.6725 24.2143 15.7857 22.3275 15.7857 20C15.7857 17.6725 17.6725 15.7857 20 15.7857C22.3275 15.7857 24.2143 17.6725 24.2143 20C24.2143 22.3274 22.3274 24.2143 20 24.2143Z"/>
          <path d="M26.9103 14.8075C27.823 14.8075 28.5629 14.0676 28.5629 13.1548C28.5629 12.2421 27.823 11.5022 26.9103 11.5022C25.9975 11.5022 25.2576 12.2421 25.2576 13.1548C25.2576 14.0676 25.9975 14.8075 26.9103 14.8075Z"/>
        </svg>
      </a>
    </div>
  </transition>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'
import useWindowSize from '../../hooks/useWindowSize'

export default {
  name: 'Socials',
  setup() {
    const {state, getters} = useStore()
    const menuShown = computed(() => state.common.menuShown)
    const {width} = useWindowSize()
    const socialLinks = computed(() => getters['common/socialLinks'])

    return {
      isHidden: computed(() => !menuShown.value && width.value < 768),
      socialLinks,
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.socials {
  display: grid;
  grid-template-columns: auto auto;
  column-gap: 25px;

  svg {
    height: 22px;
    fill: $text-color;
    transition: fill 0.3s ease-in-out;

    @include laptop() {
      height: 26px;
    }
  }

  a:hover svg {
    fill: $text-accent-color;
  }
}

.slide {
  &-enter-active,
  &-leave-active {
    transition: transform 0.5s ease-in-out;

    @include laptop() {
      transition: transform 1s ease-in-out;
    }
  }

  &-enter-from,
  &-leave-to {
    transform: translateX(calc(-100% - 24px));
  }
}
</style>