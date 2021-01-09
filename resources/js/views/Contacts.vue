<template>
  <PageLayout
    :title="i18n.$t('defaults.contacts')"
    background-color="sole"
  >
    <div class="contacts">
      <div class="contacts__categories" v-if="contacts[0]">
        <h3>{{i18n.$t('defaults.phoneNumber')}}</h3>
        <div><a :href="`tel:${contacts[0].phone}`">{{contacts[0].phone}}</a></div>
        <h3>{{i18n.$t('defaults.email')}}</h3>
        <div><a :href="`mailto:${contacts[0].email}`">{{contacts[0].email}}</a></div>
        <h3>{{i18n.$t('defaults.address')}}</h3>
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
import {computed, onMounted, ref} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../i18nPlugin'
import PageLayout from '../components/Layout/PageLayout'
import {GoogleMap} from 'vue3-google-map'
import mapStyles from '../assets/map-styles.json'

export default {
  name: 'Contacts',
  components: {GoogleMap, PageLayout},
  setup() {
    const {state, dispatch} = useStore()
    const i18n = useI18n()
    const contacts = computed(() => state.common.contacts)
    const center = ref({lat: 0, lng: 0})
    const apiKey = process.env.MIX_GOOGLE_MAPS_API_KEY

    onMounted(async () => {
      try {
        await dispatch('common/getContacts')
        const {results} = await dispatch('common/convertAddressToCoords', contacts.value[0].address)
        center.value = results[0].geometry.location
      } catch (err) {
        console.error(err)
      }
    })

    return {
      i18n,
      apiKey,
      contacts,
      center,
      mapStyles,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../assets/scss/variables";
@import "../assets/scss/breakpoints";

.contacts {
  position: relative;

  &__categories {
    margin-bottom: 16px;

    @include tablets() {
      max-width: 500px;
      top: 48px;
      left: 48px;
      display: grid;
      grid-template-columns: auto 1fr;
      column-gap: 24px;
      align-items: center;
      padding: 24px;
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

    ::v-deep > div {
      height: 100%;
    }

    @include tablets() {
      height: 66.6vh;
    }
  }
}
</style>
