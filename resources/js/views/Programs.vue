<template>
  <PageLayout
    background-color="sole"
  >
    <template v-slot:title>
      {{t('programs')}}
    </template>
    <div class="programs">
      <div class="programs__content">
        <div
          :key="program.id"
          class="programs__item"
          v-for="program in programs"
        >
          <ProgramItem :data="program" style="min-width: 0" />
          <ProgramRequestForm :program-id="program.id" />
        </div>
      </div>
    </div>
  </PageLayout>
</template>

<script>
import {computed, watchEffect} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import PageLayout from '../components/Layout/PageLayout'
import ProgramItem from '../components/Programs/ProgramItem'
import ProgramRequestForm from '../components/Programs/ProgramRequestForm'

export default {
  name: 'Programs',
  components: {ProgramRequestForm, ProgramItem, PageLayout},
  setup() {
    const {dispatch, state} = useStore()
    const {t, locale} = useI18n()
    const programs = computed(() => state.programs.programs)

    watchEffect(() => {
      dispatch('programs/getPrograms', locale.value)
    })

    return {
      t,
      programs,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";
@import "../assets/scss/page-helpers";

.programs {
  @include laptop() {
    overflow: hidden;
    position: relative;
    @include page-height;
    @include container-gradients($sole);
  }

  &__content {
    @include laptop() {
      height: 100%;
      overflow-y: auto;
    }
  }

  &__item {
    margin-bottom: $spacing-md;

    @include laptop() {
      display: grid;
      grid-template-columns: 1fr 300px;
      column-gap: $spacing-lg;
      margin-bottom: $spacing-lg;
    }

    @include large-desktop() {
      grid-template-columns: 1fr #{400px + $spacing-lg + $spacing-sm};
    }
  }
}
</style>
