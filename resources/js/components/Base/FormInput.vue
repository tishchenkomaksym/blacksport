<template>
  <div class="form-input">
    <Field
      :as="asTextarea ? 'textarea' : 'input'"
      :name="name"
      :placeholder="placeholder"
      :type="type"
      :rows="asTextarea ? 4 : null"
      :class="{light}"
      @input="onChange"
      @blur="handleBlur"
      v-if="!mask"
    />
    <Field
      :name="name"
      :placeholder="placeholder"
      :type="type"
      :class="{light}"
      @input="onChange"
      @blur="handleBlur"
      as="input"
      v-maska="mask"
      v-else
    />
    <p class="form-error" v-if="errorMessage">
      {{$t(errorMessage)}}
    </p>
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
    mask: [Array, Object, String],
    light: Boolean,
    asTextarea: {
      type: Boolean,
      default: false,
    },
  },
  emits: [
    'on-change',
  ],
  setup({name}, {emit}) {
    const {errorMessage, handleBlur, handleChange} = useField(name)

    const onChange = e => {
      handleChange(e)
      emit('on-change', e.target.value)
    }

    return {
      errorMessage,
      handleBlur,
      onChange,
    }
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/variables";

.form-input {
  margin-bottom: $spacing;

  input, textarea {
    width: 100%;
    display: block;
    margin-bottom: $spacing-sm;
  }
}
</style>