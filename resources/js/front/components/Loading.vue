<style>
.loading{
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10;
    background: white;
}
.loading-spin {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
}
</style>
<template>
    <div v-if="$store.state.loading" class="loading">
        <i class='porto-loading-icon loading-spin'></i>
    </div>
</template>

<script>
export default {}
</script>
