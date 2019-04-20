import { rutFormat } from 'rut-helpers';

export default {
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
  },
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

}
