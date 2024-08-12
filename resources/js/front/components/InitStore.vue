<template></template>

<script>
import {mapActions} from "vuex";

export default {
    name: 'init-store',
    props: ['initialData'],
    beforeMount() {
        this.$store.commit('INSERT_INITIAL_DATA', this.initialData)
        this.loadCart()
    },
    methods: {
        ...mapActions(['loadCart']),
    },
}
</script>
