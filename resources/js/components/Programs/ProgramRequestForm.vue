<template>
  <Form
    :validation-schema="validationSchema"
    @submit="submitApplication"
    class="request-form"
    v-slot="{errors}"
  >
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
      placeholder="+38 (0__) ____-__-__"
      name="phone"
      type="text"
    />
    <Button type="submit">{{i18n.$t('defaults.takePart')}}</Button>
  </Form>
</template>

<script>
import {computed, ref} from 'vue'
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
    const requestSent = ref(false)

    const submitApplication = async (values) => {
      console.log(values)
      // await dispatch('pages/submitApplication', {
      //   "program_id": "1",
      //   "name": "Arsen",
      //   "phone": "380645564545",
      //   "email": "user1@mail.com"
      // })
      requestSent.value = true
    }

    const validationSchema = computed(() =>
      Yup.object().shape({
        name: Yup.string().required(i18n.$t('defaults.requiredField')),
        email: Yup.string().email().required(i18n.$t('defaults.requiredField')),
        phone: Yup.string(),
      }))

    return {
      i18n,
      submitApplication,
      validationSchema,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

.request-form {
  h3 {
    color: $park;
  }
}
</style>