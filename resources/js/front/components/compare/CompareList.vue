<template>
    <div class="col-12 p-0 compare-content">
        <div class="d-flex product-card">
            <div class="product-box d-flex flex-column justify-content-between"></div>
            <div class="product-box d-flex flex-column justify-content-between" v-for="item in $store.getters.compareItems">
                <a class="remove-product" @click.stop.prevent="removeFromCompare(item.id)">Հեռացնել</a>
                <a class="product-link new" :href="item.publish_url">
                    <span class="img-wrap"><img loading="lazy" :src="item.main_image.urls.medium"></span>
<!--                    <v-clamp ellipsis="..." location="end" tag="h4" autoresize :max-lines="2">{{ item.title }}</v-clamp>-->
                    <h4>{{ item.title }}</h4>
                    <span class="product-price">{{ priceFormatter(item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
                    <add-to-cart-btn :prop-product="item"></add-to-cart-btn>
                </a>
            </div>
        </div>
        <div class="d-flex">
            <div class="code-box">Կոդ</div>
            <div class="code-box" v-for="item in $store.getters.compareItems">{{ item.sku }}</div>
        </div>
        <div class="d-flex">
            <div class="availability-box">Հասանելիություն</div>
            <div class="availability-box" v-for="item in $store.getters.compareItems">
                <i class="fa fa-check"></i>
                {{ item.stock_status === 'out_of_stock' ? 'Առկա չէ' : 'Առկա է' }}
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions} from "vuex";
import VClamp from 'vue-clamp';

export default {
    components: {
        'v-clamp': VClamp,
    },
    methods: {
        ...mapActions(['removeFromCompare']),
    }
}
</script>
