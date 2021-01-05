<template>
  <div class="form-input">
    <Field
      :name="name"
      :placeholder="placeholder"
      :type="type"
      @input="handleChange"
      @blur="handleBlur"
      as="input"
      v-if="!mask"
    />
    <Field
      :name="name"
      :placeholder="placeholder"
      :type="type"
      @input="handleChange"
      @blur="handleBlur"
      as="input"
      v-maska="mask"
      v-else
    />
    <p class="form-error" v-if="errorMessage">
      {{i18n.$t(errorMessage)}}
    </p>
  </div>
</template>

<script>
import {ErrorMessage, Field, useField} from 'vee-validate'
import {useI18n} from '../../i18nPlugin'

export default {
  name: 'FormInput',
  components: {ErrorMessage, Field},
  props: {
    type: {
      type: String,
      default: 'text',
    },
    name: String,
    placeholder: String,
    mask: [Array, Object, String],
  },
  setup({name}) {
    const i18n = useI18n()
    const {errorMessage, handleBlur, handleChange} = useField(name)

    return {
      i18n,
      errorMessage,
      handleBlur,
      handleChange,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

.form-input {
  margin-bottom: 16px;

  input {
    width: 100%;
    display: block;
    margin-bottom: 8px;
  }
}
</style>