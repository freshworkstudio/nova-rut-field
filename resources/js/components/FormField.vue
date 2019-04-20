<template>
  <default-field :field="field">
    <template slot="field">
      <input :id="field.name" type="text"
             class="w-full form-control form-input form-input-bordered"
             :class="errorClasses"
             :placeholder="field.name"
             @keyup="changeKeyUp"
             @blur="changeBlur"
             v-model="value"
      />
      <p v-if="hasError" class="my-2 text-danger">
        {{ firstError }}
      </p>
    </template>
  </default-field>
</template>

<script>
  import { FormField, HandlesValidationErrors } from 'laravel-nova'
  import { rutClean } from 'rut-helpers'
  import RutMixin from '../RutMixin'

  export default {
    mixins: [FormField, HandlesValidationErrors, RutMixin],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
      /*
       * Set the initial, internal value for the field.
       */
      setInitialValue () {
        this.value = this.doFormat(this.field.value) || ''
      },

      /**
       * Fill the given FormData object with the field's internal value.
       */
      fill (formData) {
        let value = this.value
        if (this.saveNormalized) {
          value = rutClean(this.value)
        }
        formData.append(this.field.attribute, value)
      },

      /**
       * Update the field's internal value.
       */
      handleChange (value) {
        this.value = value
      },

      changeKeyUp () {
        if (this.eventListener !== 'keyup') return
        this.change()
      },

      changeBlur () {
        if (this.eventListener !== 'blur') return
        this.change()
      },

      change () {
        this.value = this.doFormat(this.value) || ''
      }
    }
  }
</script>
