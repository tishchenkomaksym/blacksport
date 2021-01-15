<template>
  <PageLayout
    :title="i18n.$t('defaults.programs')"
    background-color="sole"
  >
    <div class="programs">
      <div
        :key="program.id"
        class="programs__item"
        v-for="program in programs"
      >
        <ProgramItem :data="program" style="min-width: 0" />
        <ProgramRequestForm :program-id="program.id" />
      </div>
    </div>
  </PageLayout>
</template>

<script>
import {computed, onMounted} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'
import ProgramItem from '../components/Programs/ProgramItem'
import ProgramRequestForm from '../components/Programs/ProgramRequestForm'

export default {
  name: 'Programs',
  components: {ProgramRequestForm, ProgramItem, PageLayout},
  setup() {
    const {dispatch, state} = useStore()
    const i18n = useI18n()
    const programs = computed(() => state.pages.programs)

    onMounted(() => {
      dispatch('pages/getPrograms', i18n.locale.value)
    })

    return {
      i18n,
      programs,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";

.programs {
  @include laptop() {
    max-height: calc((640 * 100vh) / 900);
    overflow-y: auto;

    &::before, &::after {
      width: calc(100% - 88px);
      max-width: calc(1440px - 88px);
      height: 40px;
      content: '';
      display: block;
      position: absolute;
      z-index: 1;
    }

    &::before {
      top: 146px;
      background: linear-gradient(180deg, $sole 0%, rgba(13, 13, 13, 0) 100%);
    }

    &::after {
      top: calc(106px + (640 * 100vh) / 900);
      background: linear-gradient(180deg, rgba(13, 13, 13, 0) 0%, $sole 100%);
    }
  }

  &__item {
    margin-bottom: 24px;

    @include laptop() {
      display: grid;
      grid-template-columns: 1fr 300px;
      column-gap: 40px;
      margin-bottom: 40px;
    }

    @include large-desktop() {
      grid-template-columns: 1fr 448px;
    }
  }
}
</style>
