<template>
  <Modal>
    <Form
      :validation-schema="validationSchema"
      @submit="orderService"
      class="service-order"
    >
      <template v-if="!isOrdered">
        <h2>{{i18n.$t('defaults.placingOrder')}} "{{serviceName}}"</h2>
        <FormInput
          :placeholder="i18n.$t('defaults.name')"
          name="name"
          type="text"
          light
        />
        <FormInput
          :placeholder="i18n.$t('defaults.email')"
          name="email"
          type="email"
          light
        />
        <FormInput
          mask="+38 (0##) ###-##-##"
          :placeholder="i18n.$t('defaults.phoneNumber')"
          name="phone"
          type="text"
          light
        />
        <Button type="submit" block link>{{i18n.$t('defaults.order')}}</Button>
      </template>
      <template v-else>
        <h1>{{i18n.$t('defaults.thankYou')}}</h1>
        <h2>{{i18n.$t('defaults.operatorContact')}}</h2>
        <Button type="reset" @click="$emit('close-modal')" block link>{{i18n.$t('defaults.close')}}</Button>
      </template>
    </Form>
  </Modal>
</template>

<script>
import {ref} from 'vue'
import {Form} from 'vee-validate'
import * as Yup from 'yup'
import {useI18n} from '../../i18nPlugin'
import Modal from '../Base/Modal'
import Button from '../Base/Button'
import FormInput from '../Base/FormInput'

export default {
  name: 'ServiceOrderModal',
  components: {FormInput, Button, Form, Modal},
  props: {
    serviceId: Number,
    serviceName: String,
  },
  setup({serviceId}) {
    const i18n = useI18n()
    const isOrdered = ref(false)

    const orderService = async () => {
      try {
        // TODO Request to api
        console.log('ordered', serviceId)
        isOrdered.value = true
      } catch (err) {
        console.error(err)
      }
    }

    const validationSchema = Yup.object().shape({
      name: Yup.string().required('defaults.requiredField'),
      email: Yup.string().email('defaults.invalidEmail').required('defaults.requiredField'),
      phone: Yup.string().length(19, 'defaults.phoneValidation').required('defaults.requiredField'),
    })

    return {
      i18n,
      isOrdered,
      orderService,
      validationSchema,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

.service-order {
  max-width: 367px;
  margin: 0 auto;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;

  &::after {
    height: 40px;
    display: block;
    content: '';
  }

  h2 {
    margin-bottom: 40px;
  }

  .form-input {
    width: 100%;
    max-width: 288px;
  }

  @include tablets() {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
}
</style>