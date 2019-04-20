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
  import { rutFormat, rutClean } from 'rut-helpers'

  export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    computed: {
      eventListener () {
        if (this.field.formatOn) return this.field.formatOn
        return 'keyup'
      },
      saveNormalized () {
        if (this.field.saveNormalized) return this.field.saveNormalized == true;
        return true
      },
      format () {
        // 0 -> COMPLETE
        // 1 -> ESCAPED
        // 2 -> WITH DASH

        if (this.field.format) return this.field.format
        return 0 // COMPLETE
      }
    },

    methods: {
      doFormat (value) {
        if (this.format === 2) { // WITH DASH
          return rutFormat(value).split('.').join('')
        }
        if (this.format === 1) { // ESCAPED
          return rutFormat(value).split('.').join('').split('-').join('')
        }
        return rutFormat(value)
      },
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
