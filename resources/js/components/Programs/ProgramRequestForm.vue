<template>
  <Form
    :validation-schema="validationSchema"
    @submit="submitApplication"
    class="request-form"
  >
    <template v-if="!requestSent">
      <h3>{{t('programApplication')}}</h3>
      <FormInput
        :placeholder="t('name')"
        name="name"
        type="text"
      />
      <FormInput
        :placeholder="t('email')"
        name="email"
        type="email"
      />
      <FormInput
        mask="+38 (0##) ###-##-##"
        placeholder="+38 (0__) ___-__-__"
        name="phone"
        type="text"
      />
      <p class="form-error" v-if="hasError">{{t('phoneExists')}}</p>
      <Button type="submit">{{t('takePart')}}</Button>
    </template>
    <template v-else>
      <h3>{{t('applicationSubmitted')}}</h3>
    </template>
  </Form>
</template>

<script>
import {ref} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from 'vue-i18n'
import {Form} from 'vee-validate'
import * as Yup from 'yup'
import Button from '../Base/Button'
import FormInput from '../Base/FormInput'

export default {
  name: 'ProgramRequestForm',
  components: {FormInput, Button, Form},
  props: {
    programId: Number,
  },
  setup(props) {
    const {dispatch} = useStore()
    const {t} = useI18n()
    const hasError = ref(false)
    const requestSent = ref(false)

    const submitApplication = async ({name, phone, email}) => {
      try {
        await dispatch('programs/submitApplication', {
          program_id: props.programId,
          name, phone, email,
        })
        requestSent.value = true
      } catch (err) {
        hasError.value = true
      }
    }

    const validationSchema = Yup.object().shape({
      name: Yup.string().required('requiredField'),
      email: Yup.string().email('invalidEmail').required('requiredField'),
      phone: Yup.string().length(19, 'phoneValidation').required('requiredField'),
    })

    return {
      t,
      submitApplication,
      validationSchema,
      hasError,
      requestSent,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.request-form {
  @include laptop() {
    padding: $spacing-md;
    transition: background-color 0.3s ease-in-out;

    &:hover, &:focus-within {
      background-color: $bg-color;
    }
  }

  h3 {
    color: $park;
  }
}
</style>