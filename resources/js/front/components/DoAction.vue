<template></template>

<script>
export default {
    props: ['action', 'when', 'args'],
    beforeMount() {
       if(this.when === 'beforeMount') {
           this.$store.dispatch(this.action, this.args)
       }
    },
    mounted() {
        if(this.when === 'mounted') {
            this.$store.dispatch(this.action, this.args)
        }
    }
}
</script>
