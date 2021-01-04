<template>
  <div class="form-input">
    <Field
      :name="name"
      :placeholder="placeholder"
      :type="type"
      @input="handleChange"
      @blur="handleBlur"
      as="input"
    />
    <ErrorMessage :name="name" class="form-input__error" />
  </div>
</template>

<script>
import {ErrorMessage, Field, useField} from 'vee-validate'

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
  },
  setup({name}) {
    const {handleBlur, handleChange} = useField(name)

    return {
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

  &__error {
    color: $red;
    font-size: 14px;
  }
}
</style>