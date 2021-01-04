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
        <ProgramItem :data="program" />
        <ProgramRequestForm />
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
@import "../assets/scss/breakpoints";

.programs {
  &__item {
    @include laptop() {
      display: grid;
      grid-template-columns: 1fr 448px;
      column-gap: 40px;
      margin-bottom: 40px;
    }
  }
}
</style>
