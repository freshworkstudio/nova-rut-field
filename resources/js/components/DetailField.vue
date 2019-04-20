<template>
  <panel-item v-if="edited_field" :field="edited_field"/>
</template>

<script>
  import { rutFormat } from 'rut-helpers'

  export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    data () {
      return {
        edited_field: null
      }
    },
    mounted () {
      this.field.value = rutFormat(this.field.value)
      this.edited_field = this.field
    }
  }
</script>
