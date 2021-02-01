<template>
  <PageLayout
    background-color="sole"
  >
    <template v-slot:title>
      {{t('contacts')}}
    </template>
    <div class="contacts">
      <div class="contacts__categories" v-if="contacts[0]">
        <h3>{{t('phoneNumber')}}</h3>
        <div><a :href="`tel:${contacts[0].phone}`">{{contacts[0].phone}}</a></div>
        <h3>{{t('email')}}</h3>
        <div><a :href="`mailto:${contacts[0].email}`">{{contacts[0].email}}</a></div>
        <h3>{{t('address')}}</h3>
        <div>{{contacts[0].address}}</div>
      </div>
      <GoogleMap
        :api-key="apiKey"
        :center="center"
        :styles="mapStyles"
        :zoom="15"
        :zoom-control="false"
        :street-view-control="false"
        :fullscreen-control="false"
        :map-type-control="false"
        :scale-control="false"
        class="contacts__map"
      />
    </div>
  </PageLayout>
</template>

<script>
import {computed, ref, watch} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import PageLayout from '../components/Layout/PageLayout'
import {GoogleMap} from 'vue3-google-map'
import mapStyles from '../assets/map-styles.json'

export default {
  name: 'Contacts',
  components: {GoogleMap, PageLayout},
  setup() {
    const {state, dispatch} = useStore()
    const {t, locale} = useI18n()
    const contacts = computed(() => state.common.contacts)
    const center = ref({lat: 0, lng: 0})
    const apiKey = process.env.MIX_GOOGLE_MAPS_API_KEY

    watch(locale, async (locale) => {
      try {
        await dispatch('common/getContacts', locale)
        const {results} = await dispatch('common/convertAddressToCoords', contacts.value[0].address)
        center.value = results[0].geometry.location
      } catch (err) {
        console.error(err)
      }
    }, {immediate: true})

    return {
      t,
      apiKey,
      contacts,
      center,
      mapStyles,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/page-helpers";
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";

.contacts {
  position: relative;

  &__categories {
    margin-bottom: $spacing;

    @include tablets() {
      max-width: 500px;
      top: calc(#{$spacing-lg} + #{$spacing-sm});
      left: calc(#{$spacing-lg} + #{$spacing-sm});
      display: grid;
      grid-template-columns: auto 1fr;
      column-gap: $spacing-md;
      align-items: center;
      padding: $spacing-md;
      position: absolute;
      z-index: 1;
      background-color: $bg-color;
    }

    h3 {
      color: $park;
    }

    a {
      color: $text-color;

      &:hover {
        color: $text-accent-color;
      }
    }
  }

  &__map {
    width: 100%;
    height: 500px;

    :deep(> div) {
      height: 100%;
    }

    @include tablets() {
      @include page-height;
      min-height: 300px;
    }
  }
}
</style>
