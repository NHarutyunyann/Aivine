<template>
    <div class="last-viewed-products-content">
        <h3 v-if="$store.getters.lastSeenItems.filter(i => i.id !== current?.id).length">Վերջին դիտված ապրանքները</h3>
        <a v-for="item in $store.getters.lastSeenItems" v-if="current?.id !== item.id" :href="item.publish_url" class="last-viewed-product-box">
            <img loading="lazy" :src="item.image" />
            <div class="product-title-price">
                <h5>{{ item.title }}</h5>
                <span v-if="item.discount_price" class="old-price">{{ priceFormatter(item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
                <span>{{ priceFormatter(item.discount_price || item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
            </div>
        </a>
    </div>
</template>
<script>
export default {
    props: ['current'],
}
</script>
