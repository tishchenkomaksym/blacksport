<template>
  <Form
    :validation-schema="validationSchema"
    @submit="confirmOrder"
    class="basket-checkout"
  >
    <div class="basket-checkout__delivery-info">
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

    <div class="basket-checkout__client-info">
      <div class="basket-checkout__group">
        <h3>{{t('recipientInformation')}}</h3>
        <FormInput
          :placeholder="t('name')"
          name="name"
        />

        <FormInput
          :placeholder="t('lastname')"
          name="lastname"
        />

        <FormInput
          :placeholder="t('patronymic')"
          name="patronymic"
        />
      </div>

      <div class="basket-checkout__group">
        <h3>{{t('contacts')}}</h3>
        <FormInput
          mask="+38 (0##) ###-##-##"
          placeholder="+38 (0__) ___-__-__"
          name="phone"
          type="text"
        />

        <FormInput
          :placeholder="t('email')"
          name="email"
          type="email"
        />
      </div>

      <div class="basket-checkout__group">
        <h3>{{t('comment')}}</h3>
        <FormInput
          :placeholder="t('orderClarifications')"
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
  </Form>
</template>

<script>
import {computed, ref, watch} from 'vue'
import {useI18n} from 'vue-i18n'
import {Form} from 'vee-validate'
import * as Yup from 'yup'
import useWindowSize from '../../hooks/useWindowSize'
import debounce from 'lodash.debounce'
import novaPoshtaApi from '../../api/nova-poshta'

import Dropdown from '../Base/Dropdown'
import FormInput from '../Base/FormInput'
import Button from '../Base/Button'

export default {
  name: 'BasketCheckout',
  components: {Button, Form, FormInput, Dropdown},
  props: {
    totalPrice: {
      type: Number,
      default: 0,
    },
  },
  setup() {
    const {width} = useWindowSize()
    const {t, locale, n} = useI18n()
    const localeType = computed(() => locale.value === 'ru' ? 'ru-RU' : locale.value === 'en' ? 'en-US' : 'uk-UA')
    // General delivery methods
    const deliveryMethods = computed(() => [
      {id: 1, value: t('novaPoshta'), description: `${t('from')} ${n(35, 'price', localeType.value)}₴`},
      // TODO Will be added later
      // {id: 2, value: t('pickup')},
    ])
    const selectedDeliveryMethod = ref({...deliveryMethods.value[0]})

    // NovaPoshta delivery methods
    const npDeliveryMethods = computed(() => [
      {id: 1, value: t('atPostOffice')},
      {id: 2, value: t('courierDelivery')},
    ])
    const selectedNpDeliveryMethod = ref({...npDeliveryMethods.value[0]})
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
    watch(selectedNpDeliveryMethod, () => selectedPaymentMethod.value = {...paymentMethods.value[0]}) // Set default payment method on NP delivery method change

    const validationSchema = computed(() => Yup.object().shape({
      address: Yup.string().required('requiredField'),
      name: Yup.string().required('requiredField'),
      lastname: Yup.string(),
      patronymic: Yup.string(),
      phone: Yup.string().length(19, 'phoneValidation').required('requiredField'),
      email: Yup.string().email('invalidEmail'),
      comment: Yup.string(),
    }))
    const canConfirm = computed(() => {
      if (selectedNpDeliveryMethod.value.id === 1) {
        return !!selectedCity.value && !!selectedPostOffice.value
      } else if (selectedNpDeliveryMethod.value.id === 2) {
        return !!selectedCity.value
      }
    })
    const confirmOrder = async (values) => {
      console.log(isOnlinePayment.value ? 'Online payment' : 'Offline payment')
      console.log('confirm order', values)
    }
    const checkoutDone = ref(false)

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
      validationSchema,
      canConfirm,
      confirmOrder,
      checkoutDone,
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
  padding: 0 $spacing;

  @include tablets() {
    height: calc(100vh - 200px);
    padding: initial;

    :deep(.select) {
      margin-bottom: $spacing;
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
