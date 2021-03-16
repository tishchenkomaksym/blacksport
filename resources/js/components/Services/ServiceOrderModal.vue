<template>
  <Modal>
    <Form
      :validation-schema="validationSchema"
      @submit="orderService"
      class="service-order"
    >
      <div class="service-order__form" v-click-away="closeModal">
        <template v-if="!isOrdered">
          <h2>{{t('placingOrder')}} "{{serviceName}}"</h2>
          <FormInput
            :placeholder="t('name')"
            name="name"
            type="text"
            light
          />
          <FormInput
            :placeholder="t('email')"
            name="email"
            type="email"
            light
          />
          <FormInput
            mask="+38 (0##) ###-##-##"
            :placeholder="t('phoneNumber')"
            name="phone"
            type="text"
            light
          />
          <p class="form-error" v-if="hasError">{{t('phoneExists')}}</p>
          <Button type="submit" link>{{t('order')}}</Button>
        </template>
        <template v-else>
          <h1>{{t('thankYou')}}</h1>
          <h2>{{t('operatorContact')}}</h2>
          <Button type="reset" @click="$emit('close-modal')" link>{{t('close')}}</Button>
        </template>
      </div>
    </Form>
  </Modal>
</template>

<script>
import {ref} from 'vue'
import {useStore} from 'vuex'
import {Form} from 'vee-validate'
import * as Yup from 'yup'
import {useI18n} from 'vue-i18n'
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
  setup(props, {emit}) {
    const {dispatch} = useStore()
    const {t} = useI18n()
    const hasError = ref(false)
    const isOrdered = ref(false)

    const orderService = async ({name, email, phone}) => {
      try {
        await dispatch('services/orderService', {
          service_id: props.serviceId,
          name, email, phone,
        })
        isOrdered.value = true
      } catch (err) {
        console.error(err)
        hasError.value = true
      }
    }

    const closeModal = () => emit('close-modal')

    const validationSchema = Yup.object().shape({
      name: Yup.string().required('requiredField'),
      email: Yup.string().email('invalidEmail').required('requiredField'),
      phone: Yup.string().length(19, 'phoneValidation').required('requiredField'),
    })

    return {
      t,
      isOrdered,
      orderService,
      validationSchema,
      hasError,
      closeModal,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";

.service-order {
  &__form {
    max-width: 367px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &::after {
    height: 40px;
    display: block;
    content: '';
  }

  h2 {
    margin-bottom: 40px;
    text-align: center;
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