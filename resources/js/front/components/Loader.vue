<template>
    <span :class="{loader: $store.getters.loading}">
        <slot></slot>
    </span>
</template>
<script>
export default {

}
</script>
