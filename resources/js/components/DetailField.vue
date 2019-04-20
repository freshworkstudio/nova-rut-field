<template>
  <panel-item v-if="edited_field" :field="edited_field"/>
</template>

<script>
  import { rutFormat } from 'rut-helpers'
  import RutMixin from '../RutMixin'

  export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    mixins: [RutMixin],
    data () {
      return {
        edited_field: null
      }
    },
    mounted () {
      this.field.value = this.doFormat(this.field.value)
      this.edited_field = this.field
    }
  }
</script>
