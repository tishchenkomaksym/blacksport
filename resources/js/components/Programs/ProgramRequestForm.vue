<template>
  <Form
    :validation-schema="validationSchema"
    @submit="submitApplication"
    class="request-form"
  >
    <template v-if="!requestSent">
      <h3>{{i18n.$t('defaults.programApplication')}}</h3>
      <FormInput
        :placeholder="i18n.$t('defaults.name')"
        name="name"
        type="text"
      />
      <FormInput
        :placeholder="i18n.$t('defaults.email')"
        name="email"
        type="email"
      />
      <FormInput
        mask="+38 (0##) ###-##-##"
        placeholder="+38 (0__) ___-__-__"
        name="phone"
        type="text"
      />
      <p class="form-error" v-if="hasError">{{i18n.$t('defaults.phoneExists')}}</p>
      <Button type="submit">{{i18n.$t('defaults.takePart')}}</Button>
    </template>
    <template v-else>
      <h3>{{i18n.$t('defaults.applicationSubmitted')}}</h3>
    </template>
  </Form>
</template>

<script>
import {ref} from 'vue'
import {useStore} from 'vuex'
import {useI18n} from '../../i18nPlugin'
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
  setup({programId}) {
    const {dispatch} = useStore()
    const i18n = useI18n()
    const hasError = ref(false)
    const requestSent = ref(false)

    const submitApplication = async ({name, phone, email}) => {
      try {
        await dispatch('pages/submitApplication', {
          program_id: programId,
          name, phone, email,
        })
        requestSent.value = true
      } catch (err) {
        hasError.value = true
      }
    }

    const validationSchema = Yup.object().shape({
      name: Yup.string().required('defaults.requiredField'),
      email: Yup.string().email('defaults.invalidEmail').required('defaults.requiredField'),
      phone: Yup.string().length(19, 'defaults.phoneValidation').required('defaults.requiredField'),
    })

    return {
      i18n,
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
    padding: 24px;
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