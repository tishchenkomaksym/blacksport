<template>
  <form
    @submit="confirmOrder"
    class="basket-checkout"
  >
    <div>
      <div class="basket-checkout__group">
        <h3>{{t('deliveryMethod')}}</h3>
        <Dropdown
          :options="deliveryMethods"
          v-model="selectedDeliveryMethod"
        />

        <Dropdown
          :options="npDeliveryMethods"
          v-model="selectedNpDeliveryMethod"
          v-if="selectedDeliveryMethod.id === 1"
        />

        <Dropdown
          :options="cities"
          :placeholder="t('selectCity')"
          @search-change="onCitySearchChanged"
          search
          v-model="selectedCity"
          v-if="selectedDeliveryMethod.id === 1"
        />

        <Dropdown
          :options="postOffices"
          :placeholder="t('postOffice')"
          @search-change="onPostOfficeSearchChanged"
          search
          v-model="selectedPostOffice"
          v-if="selectedNpDeliveryMethod.id === 1 && selectedCity"
        />

        <FormInput
          :placeholder="t('address')"
          @on-change="value => onInputChanged('address', value)"
          name="address"
          v-if="selectedNpDeliveryMethod.id === 2 && selectedCity"
        />
      </div>

      <div class="basket-checkout__group">
        <h3>{{t('paymentMethod')}}</h3>
        <Dropdown
          :options="paymentMethods"
          v-model="selectedPaymentMethod"
        />
      </div>
    </div>

    <div>
      <div class="basket-checkout__group">
        <h3>{{t('recipientInformation')}}</h3>
        <FormInput
          :placeholder="t('name')"
          @on-change="value => onInputChanged('name', value)"
          name="name"
        />

        <FormInput
          :placeholder="t('lastname')"
          @on-change="value => onInputChanged('lastname', value)"
          name="lastname"
        />

        <FormInput
          :placeholder="t('patronymic')"
          @on-change="value => onInputChanged('patronymic', value)"
          name="patronymic"
        />
      </div>

      <div class="basket-checkout__group">
        <h3>{{t('contacts')}}</h3>
        <FormInput
          @on-change="value => onInputChanged('phone', value)"
          mask="+38 (0##) ###-##-##"
          placeholder="+38 (0__) ___-__-__"
          name="phone"
          type="text"
        />

        <FormInput
          :placeholder="t('email')"
          @on-change="value => onInputChanged('email', value)"
          name="email"
          type="email"
        />
      </div>

      <div class="basket-checkout__group">
        <h3>{{t('comment')}}</h3>
        <FormInput
          :placeholder="t('orderClarifications')"
          @on-change="value => onInputChanged('comment', value)"
          as-textarea
          name="comment"
        />
      </div>
    </div>

    <div class="basket-checkout__total">
      <h3>{{t('toPay')}}</h3>
      <div class="basket-checkout__total-price">
        {{n(totalPrice, 'price', localeType)}} <span>₴</span>
      </div>
      <Button
        :block="width < 1024"
        :disabled="!canConfirm"
        type="submit"
      >{{t('confirmOrder')}}</Button>
    </div>
  </form>
</template>

<script>
import {computed, onBeforeMount, ref, watch} from 'vue'
import {useI18n} from 'vue-i18n'
import {useStore} from 'vuex'
import {useForm} from 'vee-validate'
import * as Yup from 'yup'
import useWindowSize from '../../hooks/useWindowSize'
import debounce from 'lodash.debounce'
import basketApi from '../../api/basket'
import novaPoshtaApi from '../../api/nova-poshta'

import Dropdown from '../Base/Dropdown'
import FormInput from '../Base/FormInput'
import Button from '../Base/Button'

const saveInfo = (field, value) => {
  const savedInfo = JSON.parse(sessionStorage.getItem('checkoutInfo') || '{}')
  savedInfo[field] = value
  sessionStorage.setItem('checkoutInfo', JSON.stringify(savedInfo))
}

const getInfo = field => {
  const savedInfo = JSON.parse(sessionStorage.getItem('checkoutInfo') || '{}')
  return savedInfo[field]
}

export default {
  name: 'BasketCheckout',
  components: {Button, FormInput, Dropdown},
  props: {
    totalPrice: {
      type: Number,
      default: 0,
    },
    products: {
      type: Array,
      default: [],
    },
  },
  emits: [
    'on-next-step',
  ],
  setup({products}, {emit}) {
    const {width} = useWindowSize()
    const {t, locale, n} = useI18n()
    const {dispatch} = useStore()
    const {handleSubmit} = useForm({
      validationSchema: Yup.object().shape({
        address: Yup.string().required('requiredField'),
        name: Yup.string().required('requiredField'),
        lastname: Yup.string(),
        patronymic: Yup.string(),
        phone: Yup.string().length(19, 'phoneValidation').required('requiredField'),
        email: Yup.string().email('invalidEmail'),
        comment: Yup.string(),
      }),
      initialValues: {
        address: getInfo('address') || '',
        name: getInfo('name') || '',
        lastname: getInfo('lastname') || '',
        patronymic: getInfo('patronymic') || '',
        phone: getInfo('phone') || '',
        email: getInfo('email') || '',
        comment: getInfo('comment') || '',
      },
    })
    const localeType = computed(() => locale.value === 'ru' ? 'ru-RU' : locale.value === 'en' ? 'en-US' : 'uk-UA')

    // General delivery methods
    const deliveryMethods = computed(() => [
      {id: 1, value: t('novaPoshta'), description: `${t('from')} ${n(35, 'price', localeType.value)}₴`},
      // TODO Will be added later
      // {id: 2, value: t('pickup')},
    ])
    const selectedDeliveryMethod = ref({...deliveryMethods.value[0]})
    watch(selectedDeliveryMethod, selectedDeliveryMethod => {
      saveInfo('selectedDeliveryMethod', selectedDeliveryMethod)
    })

    // NovaPoshta delivery methods
    const npDeliveryMethods = computed(() => [
      {id: 1, value: t('atPostOffice')},
      {id: 2, value: t('courierDelivery')},
    ])
    const selectedNpDeliveryMethod = ref({...npDeliveryMethods.value[0]})
    watch(selectedNpDeliveryMethod, selectedNpDeliveryMethod => {
      saveInfo('selectedNpDeliveryMethod', selectedNpDeliveryMethod)
    })
    watch(selectedDeliveryMethod, () => selectedNpDeliveryMethod.value = {...npDeliveryMethods.value[0]}) // Set default NP delivery method on delivery method change

    // Cities fetched from NovaPoshta API
    const cities = ref([])
    const selectedCity = ref(null)
    const onCitySearchChanged = debounce(async cityName => {
      if (cityName.length < 2) return
      try {
        const response = await novaPoshtaApi.searchSettlements(cityName)
        if (response.success) {
          cities.value = response.data[0].Addresses.map(city => ({
            id: city.DeliveryCity,
            value: city.Present,
          }))
        }
      } catch (err) {
        console.error(err)
        cities.value = []
      }
    }, 200)
    watch(selectedCity, selectedCity => {
      saveInfo('selectedCity', selectedCity)
    })
    watch(selectedNpDeliveryMethod, () => { // Remove city info on NP delivery method change
      cities.value = []
      selectedCity.value = null
    })

    // Post offices list when NovaPoshta selected
    const postOffices = ref([])
    const selectedPostOffice = ref(null)
    const onPostOfficeSearchChanged = debounce(async searchValue => {
      if (searchValue.length < 2) return
      try {
        const response = await novaPoshtaApi.getWarehouses(selectedCity.value.id, searchValue)
        if (response.success) {
          postOffices.value = response.data.map(postOffice => ({
            id: postOffice.SettlementRef,
            value: postOffice[locale.value === 'ru' ? 'DescriptionRu' : 'Description'],
          }))
        }
      } catch (err) {
        console.error(err)
        postOffices.value = []
      }
    }, 200)
    watch(selectedPostOffice, selectedPostOffice => {
      saveInfo('selectedPostOffice', selectedPostOffice)
    })
    watch(selectedCity, () => { // Remove post office info on city change
      postOffices.value = []
      selectedPostOffice.value = null
    })

    const paymentMethods = computed(() => {
      const defaultMethod = {id: 1, value: t('online'), description: 'WayForPay'}
      if (selectedNpDeliveryMethod.value.id === 1) {
        return [defaultMethod, {id: 2, value: t('branchPayment')}]
      } else if (selectedNpDeliveryMethod.value.id === 2) {
        return [defaultMethod, {id: 3, value: t('uponReceipt')}]
      } else {
        return [defaultMethod]
      }
    })
    const selectedPaymentMethod = ref({...paymentMethods.value[0]})
    const isOnlinePayment = computed(() => selectedPaymentMethod.value.id === 1)
    watch(selectedPaymentMethod, selectedPaymentMethod => {
      saveInfo('selectedPaymentMethod', selectedPaymentMethod)
    })
    watch(selectedNpDeliveryMethod, () => selectedPaymentMethod.value = {...paymentMethods.value[0]}) // Set default payment method on NP delivery method change

    const canConfirm = computed(() => {
      if (selectedNpDeliveryMethod.value.id === 1) {
        return !!selectedCity.value && !!selectedPostOffice.value
      } else if (selectedNpDeliveryMethod.value.id === 2) {
        return !!selectedCity.value
      }
    })
    const confirmOrder = handleSubmit(async ({address, name, lastname, patronymic, phone, email, comment}) => {
      const client = {
        delivery: selectedDeliveryMethod.value.value,
        payment_method: selectedPaymentMethod.value.value,
        post_branch: selectedPostOffice.value?.value,
        online_payment: isOnlinePayment.value,
        name: `${lastname || ''} ${name} ${patronymic || ''}`.trim(),
        phone,
        email,
        address,
        comment,
      }
      try {
        const response = await basketApi.proceedPayment(products, client)
        if (response.url) window.open(response.url, '_blank')
        await dispatch('products/deleteBasket', products.map(({id}) => id)) // Clear basket
        sessionStorage.removeItem('checkoutInfo')
        emit('on-next-step')
      } catch (err) {
        console.error(err)
      }
    })

    const onInputChanged = (field, value) => {
      saveInfo(field, value)
    }

    onBeforeMount(() => {
      const savedDeliveryMethod = getInfo('selectedDeliveryMethod')
      const savedNpDeliveryMethod = getInfo('selectedNpDeliveryMethod')
      const savedCity = getInfo('selectedCity')
      const savedPostOffice = getInfo('selectedPostOffice')
      const savedPaymentMethod = getInfo('selectedPaymentMethod')
      if (savedDeliveryMethod) {
        selectedDeliveryMethod.value = deliveryMethods.find(({id}) => id === savedDeliveryMethod.id)
      }
      if (savedNpDeliveryMethod) {
        selectedNpDeliveryMethod.value = npDeliveryMethods.value.find(({id}) => id === savedNpDeliveryMethod.id)
      }
      if (savedCity) selectedCity.value = savedCity
      if (savedPostOffice) selectedPostOffice.value = savedPostOffice
      if (savedPaymentMethod) {
        selectedPaymentMethod.value = paymentMethods.value.find(({id}) => id === savedPaymentMethod.id)
      }
    })

    return {
      t,
      n,
      width,
      deliveryMethods,
      selectedDeliveryMethod,
      npDeliveryMethods,
      selectedNpDeliveryMethod,
      cities,
      selectedCity,
      onCitySearchChanged,
      paymentMethods,
      selectedPaymentMethod,
      postOffices,
      selectedPostOffice,
      onPostOfficeSearchChanged,
      localeType,
      canConfirm,
      confirmOrder,
      onInputChanged,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.basket-checkout {
  height: calc(100vh - 50px);
  overflow-y: auto;
  overflow-x: hidden;
  padding: 0 $spacing;

  @include tablets() {
    height: calc(100vh - 200px);
    padding: 0 $spacing;

    :deep(.select) {
      margin-bottom: $spacing-sm;
    }
  }

  @include laptop() {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: $spacing-lg;
  }

  h3 {
    color: $park;
    letter-spacing: 0.08em;
  }

  &__group {
    margin-bottom: $spacing-lg;
  }

  &__total {
    button {
      margin-bottom: $spacing-md;
    }

    &-price {
      margin-bottom: $spacing;
      font-weight: 700;
      font-size: 28px;
      color: $text-accent-color;

      @include tablets() {
        font-size: 36px;
      }

      span {
        font-weight: 400;
        font-size: 20px;

        @include tablets() {
          font-size: $spacing-md;
        }
      }
    }
  }
}
</style>
