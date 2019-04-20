<template>
  <span>{{ rutFormat(field.value) }}</span>
</template>

<script>
  import { rutFormat } from 'rut-helpers'
  import RutMixin from '../RutMixin'

  export default {
    props: ['resourceName', 'field'],
    mixins: [RutMixin],
    methods: {
      rutFormat (val) {
        return this.doFormat(val) || ''
      }
    }
  }
</script>
