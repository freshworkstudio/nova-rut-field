<template>
    <default-field :field="field">
        <template slot="field">
            <input :id="field.name" type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                @keyup="change"
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
import { rutFormat, rutClean } from 'rut-helpers';
export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
          this.value = rutFormat(this.field.value) || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
          formData.append(this.field.attribute, rutClean(this.value) || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
          this.value = value
        },

        change() {
            this.value = rutFormat(this.value)
        }
    }
}
</script>
