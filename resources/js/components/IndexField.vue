<template>
    <span>{{ rutFormat(field.value) }}</span>
</template>

<script>
import { rutFormat } from 'rut-helpers';
export default {
    props: ['resourceName', 'field'],
    methods: {
        rutFormat(val) {
            return rutFormat(val);
        }
    }
}
</script>
