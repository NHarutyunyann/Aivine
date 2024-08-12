<template>
    <div class="price">
        {{ priceFormatter(product.discount_price || product.regular_price, $store.getters.currency, $store.getters.currencyRates) }}
        <span v-if="product.discount_price">{{ priceFormatter(product.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
    </div>
</template>
<script>
export default {
    props: ['product'],
}
</script>
